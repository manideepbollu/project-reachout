<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model frontend\models\ContactForm */

$this->title = 'Introduction';
?>

<!-- main content -->
<section class="main-content">

    <!-- content wrapper -->
    <div class="content-wrap">

        <!-- inner content wrapper - View content i.e. $content is being passed here -->
        <div class="wrapper">

            <div>
                <!-- Begin flash messages if any -->
                <?php
                foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                    echo '<div class="alert text-center bg-'. $key .'">' . $message . '</div>';
                }
                ?>
                <!-- End flash messages -->
            </div>

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <div class="site-index">

                <div class="jumbotron text-center mb0">
                    <h1>SCINTIN</h1>
                    <p class="lead">AN ERP + SCHOOL NETWORK PROJECT</p>
                    <p><a class="btn btn-lg btn-primary" href="<?= Yii::$app->urlManager->createUrl('site/dashboard') ?>">Dashboard (sample)</a></p>
                </div>

                <div class="body-content pl25 pr25 pb20 bg-white">
                    <div class="row">
                        <div class="col-lg-8">

                            <h2 id="introduction">Introduction</h2>
                            <p>
                                SCINTIN is an ERP + School Network project. The aim of this project is to create a 4th generation Enterprise resource planner which can address all the issues involved in administering a school/college. Being a next generation ERP, it doesn’t stop with financial and administrative functions but also extends up to school network and integrates all the academic, administrative and social functions into one big application and we tentatively named it SCINTIN. Considering the scope and functionality of this application, SCINTIN can be recognized as an abbreviation for “<b>S</b>​c​hool <b>C</b>​o​llege <b>I</b>​n​stitutional <b>N​</b>e<b>​T</b>​w​ork <b>I​N</b>t​egrator”.
                            </p>
                            <br>

                            <h2 id="inspiration">Inspiration</h2>
                            <p>
                                SCINTIN is an inspiration from Fedena, a popular all-in-one software for school and colleges. Though it has a solid ERP structure to hold administrative and finance data of an institution, it lacks flexibility and customization. It provides a very basic school network functionality and poor GUI due to which users (Students, teachers and parents) may not be able to use it as a part of their everyday business.
                            </p>
                            <p>
                                Considering many such aspects, we have decided to build a solid ERP which is customizable as per the school needs and a feature rich school network which enables students, employees and parents to connect to the school effortlessly. Being a comprehensive School/College software, it handles various aspects of school administration. below is the list of identified core categories which feature in SCINTIN.
                            </p>
                            <ul>
                                <li>Finances (fee, payslips, definition of cost centres etc.)</li>
                                <li>Academics (courses, batches, exams, results, research, assignments etc.)</li>
                                <li>Library (books, transactions, fines, library fee, etc.)</li>
                                <li>School (school data, stats, achievements, hall of fame etc.)</li>
                                <li>Social (news, people, chatting, group discussions, media sharing etc.)</li>
                                <li>Sports (teams, coaches, squads, resources, fitness schedules etc.)</li>
                                <li>Hostel (types of rooms, subscriptions, remarks, food etc.)</li>
                                <li>Transport (routes, bus stops, drivers, vehicles etc.)</li>
                            </ul>
                            <br>
                            <img src="img/ScintinBD.jpg" width="600">
                            <br><br>

                            <h2 id="technical_details">Technical Details</h2>
                            <p>
                                This project is being developed right from scratch. PHP and Javascript are the two major languages which are being used while developing this application. This application is based on bootstrap and Yii Framework 2.0. Yii Framework is one of the best framework which supports
                                ORM (Object Relational Mapping), AJAX-enabled widgets, Web services, Internationalization (Multilingual software) and many more such 4th generation concepts. SCINTIN follows a traditional MVC architecture which makes it easy for customization and scalability.
                            </p>
                            <p>
                                So many cutting-edge APIs and plug-ins are being integrated to make sure that this application is highly advanced and provides the best GUI experience by the time it is released. Few APIs such as Google Maps (transport), Google Calendars (events, exams and assignments) and Google Drive (file/media sharing) can take this application to next level.
                            </p>
                            <p>
                                This application supports both Oracle and MySQL as its database which gives more options for the school which implements SCINTIN. Ideally, SCINTIN has to be hosted on AWS - Amazon Web services.
                            </p>
                            <br>
                            <img src="img/ScintinTL.jpg" width="600">
                            <br><br>

                            <h2 id="security_concepts">Security Concepts</h2>

                            <p>
                                Since this entire application is being hosted on cloud and can be accessed through web browsers and APIs, security is being considered as the most important aspect of the entire project. Our security architecture is based on Yii 2.0 framework and RBAC concepts. Security measures include c​ross-site scripting ​(XSS) prevention, c​ross-site request forgery​ (CSRF) prevention, c​ookie​tampering prevention, etc. SCINTIN users are ideally mapped to their google accounts in order to enjoy access to all features (few features are powered by Google Apps).
                            </p>
                            <br><br>

                            <p id="credentials"><b>A joint effort of</b><br>
                                Manideep Bollu - m​anideep@msn.com​ <br>
                                Kalyan Venkat - k​alyan.venkat21@gmail.com <br>
                                Reddy Girish Gaddam - gaddamreddygirish@gmail.com
                                ​</p>
                        </div>
                        <div class="col-lg-4">
                            <!-- Bollu -> Know more section begins -->
                            <section class="panel mt15">
                                <div class="panel-heading">
                                    <b>What are we up to?</b>
                                </div>
                                <div class="panel-body">
                                    <ul class="pl20">
                                        <li>
                                            <a href="#introduction">
                                                <span>Introduction</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#inspiration">
                                                <span>Inspiration</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#technical_details">
                                                <span>Technical Details</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#security_concepts">
                                                <span>Security Concepts</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#credentials">
                                                <span>Credentials</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            <!-- Bollu -> Know more section ends -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /inner content wrapper -->

    </div>
    <!-- /content wrapper -->
    <a class="exit-offscreen"></a>
</section>
<!-- /main content -->
