<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="dashboard.php" class="media-left"><i class="icon icon-library2" style="color: #FFDC0A; font-weight: bolder; font-size: xx-large"></i></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold" style="color: #FFDC0A; font-weight: bolder; font-size: x-large">Dashboard</span>
                    </div>

                    <div class="media-left">
                        <ul class="icons-list">
                            <li>
                                <a href="../admin/dashboard.php?dashboard_ai"><div align="left"><img src="assets/images/ai.png" class="img-responsive" style="width: 50px; height: 50px;" /></div></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <?php if(str_contains($access,'ISCED') && $actype == "GTEC"){?><li class="menu-item"><a href="../admin/dashboard.php?isced"><i class="icon-home9"></i> <span>ISCED</span></a></li><?php } ?>
                    <?php if(str_contains($access,'Contact') || str_contains($access,'Programs') || str_contains($access,'Proposed')){?>
                    <li>
                        <a href="#"class="menu-item"><i class="icon-medal"></i> <span>Accreditation</span></a>
                        <ul>
                            <?php if(str_contains($access,'Programs') && strpos($mypermission,'create') !== false){?><li><a href="../admin/dashboard.php?add_acc_programs"><i class="icon-add-to-list"></i><span>Add Accreditation</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Programs') && strpos($mypermission,'create') !== false){?><li><a onclick="bulkUploads('appadmissions', 'add_accreditation', 'yes')"><i class="icon-folder-upload3"></i><span>Bulk Accreditation</span></a></li><?php } ?>
                            <!--<?php if(str_contains($access,'Proposed') && strpos($mypermission,'create') !== false){?><li><a href="../admin/dashboard.php?acc_proposed_programs"><i class="icon-book2"></i><span>Add New Proposal</span></a></li><?php } ?>-->
                            <?php if(str_contains($access,'Programs')){?>

                                <li>
                                    <a href="#"><i class="icon-pie-chart5"></i> <span>View</span></a>
                                    <ul>
                                        <li><a href="../admin/dashboard.php?acc_programs"><i class="icon-markup"></i><span>Accreditations</span></a></li>
                                        <!--<li><a href="../admin/dashboard.php?view_proposals"><i class="icon-eye4"></i><span>Proposals</span></a></li>
                                        <?php if($actype == "GTEC"){?><li><a href="../admin/dashboard.php?programs"><i class="icon-book3"></i><span>Programmes</span></a></li><?php } ?>-->
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } if((str_contains($access,'Institution Category') || str_contains($access,'Institution')) && $actype == "GTEC"){?>
                    <li>
                        <a href="#"class="menu-item"><i class="icon-home7"></i> <span>Institutions</span></a>
                        <ul>
                            <!--<?php if(str_contains($access,'Contact')){?><li><a href="../admin/dashboard.php?acc_contact"><i class="icon-mobile"></i><span>Contact</span></a></li><?php } ?>-->
                            <?php if(str_contains($access,'Institution Category')){?><li><a href="../admin/dashboard.php?institution_category"><i class="icon-mobile"></i><span>Category</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Institution Category')){?><li><a href="../admin/dashboard.php?institution_colleges"><i class="icon-mobile"></i><span>Colleges</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Institution Category')){?><li><a href="../admin/dashboard.php?institution_faculties"><i class="icon-mobile"></i><span>Faculties</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Institution Category')){?><li><a href="../admin/dashboard.php?institution_departments"><i class="icon-mobile"></i><span>Departments</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Institution') && strpos($mypermission,'create') !== false){?><li><a href="../admin/dashboard.php?institutions"><i class="icon-book3"></i><span>Add Institutions</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Institution')){?><li><a href="../admin/dashboard.php?view_institutions"><i class="icon-file-eye2"></i><span>View Institutions</span></a></li><?php } ?>
                        </ul>
                    </li>
                    <?php } if(str_contains($access,'Staff Category') || str_contains($access,'Staff,') || str_contains($access,'Publications')){?>
                    <li>
                        <a href="#" class="menu-item"><i class="icon-users2"></i> <span>Staff</span></a>
                        <ul>
                            <?php if(str_contains($access,'Staff Category') && $actype == "GTEC"){?><li><a href="../admin/dashboard.php?staff_category" id="layout1"><i class="icon-make-group"></i><span>Category</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Staff Category') && $actype == "GTEC"){?><li><a href="../admin/dashboard.php?staff_ranks" id="layout1"><i class="icon-make-group"></i><span>Ranks</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Staff,') && strpos($mypermission,'create') !== false){?><li><a href="../admin/dashboard.php?staff" id="layout2"><i class="icon-users4"></i><span>Add Staff</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Staff,') && strpos($mypermission,'create') !== false){?><li><a onclick="bulkUploads('appadmissions', 'add_staff', 'yes')"><i class="icon-folder-upload3"></i><span>Bulk Staff Upload</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Publications') && strpos($mypermission,'create') !== false){?><li><a href="../admin/dashboard.php?add_publication" id="layout3"><i class="icon-newspaper2"></i><span>Add Publications</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Publications') && strpos($mypermission,'create') !== false){?><li><a href="../admin/dashboard.php?add_conferences_and_workshops" id="layout4"><i class="icon-hammer2"></i><span>Add Conference/Workshop</span></a></li><?php } ?>
                            <li>
                                <a href="#"><i class="icon-pie-chart5"></i> <span>View Data</span></a>
                                <ul>
                                    <?php if(str_contains($access,'Publications')){?><li><a href="../admin/dashboard.php?conferences_and_workshops" id="layout4"><i class="icon-hammer2"></i><span>Conference/Workshop</span></a></li><?php } ?>
                                    <?php if(str_contains($access,'Staff,')){?><li><a href="../admin/dashboard.php?staff_records" id="layout2"><i class="icon-users4"></i><span>Staff</span></a></li><?php } ?>
                                    <?php if(str_contains($access,'Publications')){?><li><a href="../admin/dashboard.php?publication" id="layout3"><i class="icon-newspaper2"></i><span>Publications</span></a></li><?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <?php } /*if(str_contains($access,'Applications') || str_contains($access,'Enrollments') || str_contains($access,'Graduations')){?>
                    <li>
                        <a href="#" class="menu-item"><i class="icon-users4"></i> <span>Application Mgt</span></a>
                        <ul>
                            <?php if(str_contains($access,'Applications') && strpos($mypermission,'create') !== false){?><li><a href="../admin/dashboard.php?student_application"><i class="icon-pen6"></i><span>Add Applications</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Applications')){?><li><a href="../admin/dashboard.php?view_application_data"><i class="icon-file-eye2"></i><span>View Applications</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Applications') && strpos($mypermission,'create') !== false){?><li><a onclick="bulkUploads('appadmissions', 'application', 'yes')"><i class="icon-folder-upload3"></i><span>Bulk Applications</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Applications') && strpos($mypermission,'update') !== false){?><li><a href="../admin/dashboard.php?student_admissions"><i class="icon-graduation"></i><span>Admit Student</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Enrollments') && strpos($mypermission,'update') !== false){?><li><a href="../admin/dashboard.php?student_enrollments"><i class="icon-user-plus"></i><span>Enroll Student</span></a></li><?php } ?>

                        </ul>
                    </li>
                        <?php }*/if(str_contains($access,'Enrollments')) { ?>
                    <li>
                        <a href="#" class="menu-item"><i class="icon-users4"></i> <span>Students</span></a>
                        <ul>
                            <?php if(str_contains($access,'Enrollments') && strpos($mypermission,'create') !== false){?><li><a href="../admin/dashboard.php?add_student"><i class="icon-user-plus"></i><span>Add Students</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Enrollments') && strpos($mypermission,'create') !== false){?><li><a onclick="bulkUploads('appadmissions', 'add_student', 'yes')"><i class="icon-folder-upload3"></i><span>Bulk Student Upload</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Enrollments') && strpos($mypermission,'create') !== false){?><li><a onclick="bulkUploads('appadmissions','graduated')"><i class="icon-folder-upload3"></i><span>Bulk Graduate Upload</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Enrollments')){?><li><a href="../admin/dashboard.php?students_records"><i class="icon-user-plus"></i><span>Students Records</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Graduations')){?><li><a href="../admin/dashboard.php?student_graduation"><i class="icon-graduation2"></i><span>Graduates Records</span></a></li><?php } ?>
                        </ul>
                    </li>
                    <?php } if(str_contains($access,'Summary Report') || str_contains($access,'Analytics Report')){?>
                    <li>
                        <a href="#" class="menu-item"><i class="icon-pie-chart7"></i> <span>Reports</span></a>
                        <ul>
                            <?php if(str_contains($access,'Summary Report')){?><li><a href="../admin/dashboard.php?summary_report"><i class="icon-pie-chart8"></i><span>Summary</span></a></li><?php } ?>
                            <?php if(str_contains($access,'Analytics Report')){?><li><a href="../admin/dashboard.php?analytics_report"><i class="icon-pie-chart8"></i><span>Analytics</span></a></li><?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="menu-item" style="color: #FFDC0A;">System</li>
                    <?php if((str_contains($access,'Users') || str_contains($access,'User Roles')) && $actype == "GTEC" ){?>
                    <li>
                        <a href="#"class="menu-item"><i class="icon-user-plus"></i> <span>Accounts</span></a>
                        <ul>
                            <?php if(str_contains($access,'Users')){?><li><a href="../admin/dashboard.php?users"><i class="icon-user-plus"></i><span>Users</span></a></li><?php } ?>
                            <?php if(str_contains($access,'User Roles')){?><li><a href="../admin/dashboard.php?user_roles"><i class="icon-user-check"></i><span>User Roles</span></a></li><?php } ?>
                        </ul>
                    </li>
                    <?php }if($actype == "GTEC" ){?>
                        <li>
                            <a href="#"class="menu-item"><i class="icon-cog52"></i> <span>AI Configurations</span></a>
                            <ul>
                                <li><a onclick="enrollmentTarget()"><i class="icon-user-plus"></i><span>Enrollment Targets</span></a></li>
                            </ul>
                        </li>
                    <?php } if((str_contains($access,'Logs')) && $actype == "GTEC"){?><li class="menu-item"><a href="../admin/dashboard.php?log_details"><i class="icon-newspaper2"></i> <span>Logs</span></a></li><?php } ?>


                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>