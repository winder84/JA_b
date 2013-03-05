#!/usr/bin/perl

use strict;
use CGI (-no_xhtml);

my $q = new CGI;
my $c = 'xn--80aaagabsufuc5b1amej.xn--p1ai';

my $work_dir = './';
my ($cm, $cy) = (localtime (time))[4,5];
my $month;
my $year;
my @files;
my $ym;
my %ym;
my $yearmonth;

print $q->header (-type		=>	'text/html',
				  -charset	=>	'windows-1251');

opendir (DIR, $work_dir) || die "can't opendir $work_dir : $!";
while (my $file = readdir DIR) {
    if (grep (/^awstats.*\d{4}\.html$/, $file) && -f "$work_dir/$file") {
        $file =~ s/^.*\.(\d{6})\.html$/\1/g; 
        push @files, $file;
    }
}
closedir DIR;

if ((!$q->param ('yearmonth')) or ($q->param ('yearmonth') !~ /^\d{6}$/)) {
	$month = $cm+1;
    $month = sprintf ("%02d", $month);
	$year = $cy+1900;
    $yearmonth = $year.$month;
} else {$yearmonth = $q->param ('yearmonth');}

my $path = 'awstats.' . $c . '.' . $yearmonth . '.html';

my %ml = ('01' => 'Январь',
          '02' => 'Февраль',
          '03' => 'Март',
          '04' => 'Апрель',
          '05' => 'Май',
          '06' => 'Июнь',
          '07' => 'Июль',
          '08' => 'Август',
          '09' => 'Сентябрь',
          '10' => 'Октябрь',
          '11' => 'Ноябрь',
          '12' => 'Декабрь');

foreach my $awym (sort @files) {
    my $awy = substr ($awym, 0, 4);
    my $awm = substr ($awym, 4);
    $ym{$awym} = "$ml{$awm} - $awy";
}

my $f = $q->startform (-name	=>	'FormDateFilter',
					   -method	=>	'POST',
					   -action	=>	'',
					   -style	=>	'padding: 0px 0px 0px 0px; margin-top: 0') . 

        $q->popup_menu (-name	=>	'yearmonth',
						-class	=>	'aws_formfield',
						-default=>	$year.$month,
						-values	=>	[sort keys %ym],
						-labels	=>	\%ym) .

		$q->submit (-name	=>	'OK',
					-class	=>	'aws_button',
					-value	=>	'OK') .
	$q->endform;

if (open (H, "< $path")) {
	while (<H>) {
		s/\<form\sname="FormDateFilter".*\>//mi;
		s/\<span\sstyle\=\"font\-size\:\s14px\;\"\>.*\d{4}<\/span\>/$f/mi;
		s/^\<\/form\>//mi;
		print;
	}
	close (H); 
} else {

	print $q->start_html (-dtd		=>	'-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd',
						  -lang		=>	"ru",
						  -encoding	=>	"windows-1251",
						  -title	=>	"Статистика за $c - страница не найдена.",
						  -script	=>	"setTimeout(\"document.location.href='./'\", 4000)",
						  -style	=>	{-code	=> qq (
body {
	  font-family: Tahoma;
	  font-size: 9pt;
	  color: black;
} 
a {
	color: #880000;
	font-size: 12px;
}
h2 {
	font-size: 18px;
	color: #880000;
	font-weight: bold;
	text-align: center;
	padding-top: 50px;
}
h3 {
	font-size: 16px;
	color: #333333;
	font-weight: bold;
	text-align: center;
	padding-top: 3px;
	padding-bottom: 3px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
}
h3 a {
	  font-size: 16px;
}
h4 {
	font-weight:bold;
	font-size:14px;
	margin-left:20px;
}
hr {
	margin-top: 200px;
	text-align: center;
	margin-right: 100px;
	margin-left: 100px;
	size: 1px;
}
.compact_li {
			 display: list-item;
			 margin-left: 2em;
			 list-style-type: disc;
}
.sub {
	  margin-left: 100px;
	  margin-right: 120px;
}
table {
	   font-size: 9pt
}
)}
				);
	print $q->h2 ("Файл со статистикой, за период", $q->span ({style=>"color: #FF0000"}, "$ml{$month} $year"), ", не найден."),
		  $q->h3 ("В течение нескольких секунд, Вы будете перенаправлены на главную страницу,<br>
				   если не хотите ждать, то нажмите", $q->a ({href=>'./'}, "сюда"), "."),
		  $q->hr,
		  $q->div ({class	=>	'sub'},
				$q->h4 ("Оглавление технической документации:"),
				$q->ul ($q->li ($q->a ({href=>'http://www.1gb.ru/services_faq.php'},
											  "<b>FAQ</b> (часто задаваемые вопросы);")),
						$q->li ($q->a ({href=>'http://www.1gb.ru/services.php'},
											  "Техническое описание услуг;")),
						$q->li ($q->a ({href=>'http://www.1gb.ru/hosting_reference.php'},
											  "Рекомендации по программированию;"))
								),
																
	$q->start_table (
						   {cellspacing	=>	0,
							cellpadding	=>	0,
							border		=>	0,
							width		=>	"100%"
							}),
		  	  $q->Tr ($q->td ({valign	=>	'top',
							   width	=>	43}), 


							$q->img ({src		=>	"https://www.1gb.ru/1gbrudesign_images/!_.gif",
														   width	=>	43,
														   height	=>	28,
														   border	=>	0}),
					  $q->td ({width		=>	1,
							   background	=>	"http://1gb.ru/1gbrudesign_images/red.gif"}),
					  $q->td ({style		=>	"padding: 10px",
								 bgcolor	=>	"#d9d9d9"}, $q->strong ("Мы всегда готовы ответить на ваши вопросы!<br>&nbsp;"),
															$q->div ({class	=>	'compact_li'}, "Любые вопросы и поддержка - ", 
															$q->a ({href=>'mailto:support@1gb.ru'}, 'support@1gb.ru'))
																	)
								),
							
						
		  $q->end_table);
	print $q->end_html;
}
