#!/usr/bin/perl
use CGI::Carp;
use CGI qw(:standard fatalsToBrowser);
use Date::Calc qw(Calendar);
use Getopt::Long;
print header({ -content_type => "text/plain" });
my @cmds = split /\s*(&&|\|\||;+)\s*/, "cal " . (param("cal") || "");
push @cmds, ";" if @cmds % 2;
my %cmds = @cmds;
foreach my $cmd (grep exists $cmds{$_}, @cmds) {
  my $return = 0;
  if ($cmd =~ m/^cal(?: (.*))?/) {
    $return = cal($1);
  }
  elsif ($cmd =~ m/^ls(?: (.*))?/) {
    $return = ls($1);
  }
  elsif ($cmd =~ m/^cat(?: (.*))?/) {
    $return = cat($1);
  }
  else {
    warn "Bad command or file name";
  }
  last if $cmds{$cmd} eq "&&" && !$return;
  last if $cmds{$cmd} eq "||" && $return;
}
sub cal {
  @ARGV = split /\s+/, shift;
  my $month_count = 1;
  my $orthadox = 0;
  GetOptions(
    1 => sub { $month_count = 1 },    # show one month (default)
    3 => sub { $month_count = 3 },    # show previous and next months too
    s => sub { $orthadox = 1 },       # start on a sunday
    m => sub { $orthadox = 0 },       # start on a monday
    y => sub { $month_count = 1 }     # show the whole year
  );
  my @month_short = qw(jan feb mar apr may jun jul aug sep oct nov dec);
  my @month_long = qw(january february march april may june july august
    september november december);
  my ($month, $year) = grep !/^-/, @ARGV;
  if (defined $month && !defined $year) {
    $year = $month;
    $month = 1;
    $month_count = 12;
  }
  # resolve named months
  for my $i (1 .. @month_short) {
    $month = $i and last if $month_short[$i - 1] eq lc $month;
  }
  for my $i (1 .. @month_long) {
    $month = $i and last if $month_long[$i - 1] eq lc $month;
  }
  $month = (localtime)[4] + 1 unless defined $month;
  $year = (localtime)[5] + 1900 unless defined $year;
  warn "cal: $month is neither a month number (1..12) nor a name\n" and return 0
    unless $month >= 1 && $month <= 12;
  $month-- if defined $month;
  $month = 0 if $month_count == 12;
  $month-- if $month_count == 3;
  $month = int $month;
  for my $m (1 .. $month_count) {
    print Calendar($year, $month + $m, $orthadox), "\n";
  }
  1;
}

sub ls {
  my (@paths) = grep !/^-/, split /\s+/, shift;
  push @paths, "." unless @paths;
  foreach my $path (@paths) {
    $path =~ s#/+#/#g;
    $path =~ s#^\./##;
    $path = "." if $path =~ m/\*/ && $path !~ m/\.\./;
    $path = ".." if $path =~ m/\*/ && $path =~ m/\.\./;
    warn "ls: $path: Permission denied\n" and return 0 unless grep $path eq $_,
      qw(. .. ../ index.php cal.pl k1kh31b1n55h.php), "";
    opendir my $dir, "./$path";
    print join "\n", readdir $dir;
    closedir $dir;
  }
  1;
}

sub cat {
  my (@files) = grep !/^-/, split /\s+/, shift;
  foreach my $file (@files) {
    $file =~ s#/+#/#g;
    $file =~ s#^\./##;
    warn "cat: $file: Permission denied\n" and return 0 unless grep $file eq $_,
      qw(cal.pl);
    open my $fh, "<", "./$file";
    print while <$fh>;
    close $fh;
  }
  1;
}

