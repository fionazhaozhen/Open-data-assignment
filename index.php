<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Freelancer - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="build/nv.d3.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->

    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/visualization1.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/simple.css" />
    <link rel="stylesheet" type="text/css" href="css/nv.d3.css" />

</head>

<body id="page-top" class="index">
    <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">HomePage</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">Data Cleaning</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">Data Visualization 1</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">Data Visualization 2</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="img/profile.png" alt="">
                    <div class="intro-text">
                        <span class="name">Open Data Innovation Assignment_1</span>
                        <hr class="star-light">
                        <div><span class="skills">Name: Zhen Zhao</span></div>
                        <div><span class="skills">Email: zz7g14@soton.ac.uk</span></div>
                        <div><span class="skills">MSc Software Engineering</span></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Data Cleaning</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <h3>Creating</h3>
                <p>
                    First, we need to create a project by importing the given dataset which its type is comma separated value. When it is loaded in, we should parse data as CSV file which columns are separated by commas and ignore title lines to adjust the format of this dataset. And then, generate a project by a given name.                        
                </p>
                <h3>Sorting and Faceting for five mistakes</h3>
                <p>
                    The next step is to sort and facet rows and columns. After quick exploring and viewing of the dataset, we find that there are some format errors that need to be manipulated. In order to observe the content of column, it is useful to facet rows based on a column. First, the column “Agency Name” has been selected to facet as text and the filter shows following different errors:
                </p>
                <div>
                    <p>
                        1.  Multiple Representations
                    </p>
                    <p><img src="img/odi/2.png"/></p>
                    <p>
                        As the images shown above, this value “Department of Agriculture” has multiple representations. This kind of error involves trailing space. The solution of solving this problem is to use a trim space transform on the “Agency Name” column to clean these errors in all. And the process has been shown in the following image:
                    </p>
                    <p><img src="img/odi/3.png"/></p>
                </div>
                <div>
                    <p>
                        2.  Summation Records
                    </p>
                    <p>
                        There mains many summation records in the data set. The method is to star these records and delate them later.
                    </p>
                    <p><img src="img/odi/4.png"/><img src="img/odi/5.png"/></p>
                </div>
                <div>
                    <p>
                        3.  Mixed value (Units included)
                    </p>
                    <p>
                        In the column “LifeCycle Cost”, both text values and numeric values have been contained. Thus, we have to fix non-numeric values. There is a method using expression language to call string function “replace(“($m)”, “”)”, and extra field “($m)” can be deleted.
                    </p>
                    <p><img src="img/odi/6.png"/></p>
                    <p>Then, it is necessary to edit these records and transform text value to numeric value.</p>
                    <p><img src="img/odi/7.png"/></p>
                    <p>Until finishing the above execution, there is no non-numeric value in “LifeCycle Cost” column.</p>
                    <p><img src="img/odi/8.png" /></p>
                </div>
                <div>
                    <p>
                        4.  Redundant Data
                    </p>
                    <p>
                        There is unnecessary to use both “Agency Code” and “Agency Name”, thus we can combine them together. The solution is to add a new column called “Agency” which based on the column “Agency Name” and also add the value of “Agency Code”. After this step, delete original columns “Agency Code” and “Agency Name”.
                    </p>
                    <p><img src="img/odi/9.png" /></p>
                </div>
                <div>
                    <p>
                        5.  Date Validation
                    </p>
                    <p>
                        Consider the format of date are different in “start Date” and “Complete Date” that some date value format as “dd/mm/yyyy” and some value format as “mm/dd/yyyy”. For example, in following figure, it is hard to recognize the start date of the project which name is “Operations”. The date could be 1st October 2011, but it also can be think as 10th January 2011.
                    <p>
                    <p><img src="img/odi/10.png" /><img src="img/odi/12.png"></p>
                    <p>
                        It is also easily to find that there remains not only one format of date representation that one would be “dd/mm/yyyy”, the other one could be “mm/dd/yyyy” and another one is “yyyy-dd-mm”. Thus, it is necessary to identify a uniform date format. The solution is to transform the whole column’s value to date. And then delete blank records. 
                    </p>
                    <p><img src="img/odi/11.png" /></p>
                    <p>
                        After transforming all records into date values, it is clear to see that there are only one format of date which is “yyyy-mm-dd’T’hh:mm:ss’Z’”. To check the value, we can use timeline filter to display this column’s all values.
                    </p>
                    <p><img src="img/odi/13.png"></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visual 1 Section -->
    <section id="about">
        <div class="container">
        <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>The consumption of Different Agencies' Projects</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
                <script type="text/javascript" src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
                
                <div>   
                    <div id="visual1" style="float:left; width:82%; height:700px; position:relative; margin-left:-300px;">
                        <h3 align="center">Total Actual Cost of Agencies</h3>
                        <label><input type="checkbox"> Sort values</label>
                        <h4 align="center" style="float: bottom;">X axis: Agency Code</h4>
                    </div>
                    <div id="visual2" style=" float: right; width:68%; height:700px; position:relative;  margin-right: -300px;">
                        <h3 align="center">Top 7 costs of projects per Agency</h3>      
                    </div>
                </div>
                <div>
                    <p>Visualization description</p>
                    <p>
                        I would like to clearly reflect the consumption of all agency and the distribution of costs within each agency. The first visualization is drawn by JavaScript with the using of D3 library. This visualization contains two parts that the bar chart shows the classification of total actual cost of agencies and the circle displays the 7 projects with highest costs in each agency.
                    </p>
                    <p>
                        As the bar chart looks like, at the beginning, bars are sorted by the sequence of their agency codes because the agency code could be the unique identification of each agency which means one agency only has one relevant code and each code can only represent one agency. When users select the top right check box to sort values of these bars in descending order. And once users hover over each bar, a tip box will jump to display the agency name and the detail costs of this agency. Meanwhile, the value of circular arcs will be changed with the selecting of different bars. It can be easily found that there are 7 colors that each color represents each project. The table below the donut chart exhibits project name and project ID of each color area.
                    </p>
                    <p>
                        This visualization provides interaction through powerful filtering and selection to help audience analyze the consumption conditions of agencies and the projects within each agency.
                    </p>
                </div>
                <script type="text/javascript" src="d3/visual2.js"></script>
            </div>
            
        </div>
    </section>

    <!-- Visual 2 section -->
    <section id="contact" style="background-color:white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>The Annual Cost of Different Agencies</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <script src="build/nv.d3.js"></script>
                <script type="text/javascript" src="d3/visual1.js"></script>
                <div >
                    <div id="pageContent" style="width:100%; height: 700px;">
                        <svg></svg>
                    </div>
                </div>
            </div>
            <div>
                <p>Visualization Description</p>
                <p>
                    The second visualization is design to illustrate the annual actual costs of each agency. This graph can help audience to analyze the annual investment for project research and quickly find the main reason that leads to a rapid increasing of total consumption. This visualization is programmed by JavaScript by using of nvd3 library. This is a powerful re-usable charts for D3.js which provides many well-structured charts and well-designed examples. This visualization is a scatter chart that each point reflects the cost of some agency in some year. In case of many points concentrating in some area results in an obstruction of visual effects, spots are classified by agency name.
                </p>
                <p>
                    There are three events on each agency radio button. When users click any empty circle button of agency, the button will turn to solid circle and points relevant to this agency can be displayed in the coordinate graph. If audience click any solid circle button of agency, the effect of this event will be opposite to single clicking to empty circle that the relevant spots will disappear from graph. And the last event is that audience double click any kinds of radio button whatever it is empty circle or solid circle, points only belongs to this agency can be illustrated in coordinate graph.
                </p>
                <p>
                    These three mouse click events provide interaction between data visualization graph and audience. Users can easily analyze annual cost of each agency and compare costs between agencies though using radio buttons to filter data.
                </p>
            </div>
        </div>
    </section>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/cabin.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/cake.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/circus.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/game.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/safe.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/submarine.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>