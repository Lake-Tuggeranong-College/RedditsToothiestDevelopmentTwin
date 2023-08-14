this is Declans file


Gantt Chart

gantt
    title Coffee App Implementation
    dateFormat YYYY-MM-DD
    section MVP
	       1.1    :v1, 2014-01-01, 20d
	       2.1    :after v1, 5d
				 3.1    :after v1, 2d
				 4.1    :2014-01-05, 3d
    section Version2
         1.2    :v2, 2014-02-01, 20d
	       2.2    :after v2, 10d
				 3.2    :after v2, 5d
				 4.2    :after v1, 20d
				 5.2    :after v2, 20d
		section Version3
				 4.3    :v3, after v2, 60d
				 5.3    :after v2, 30d
