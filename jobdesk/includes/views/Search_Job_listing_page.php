<div class="jd-featured-jobs-box">
   <div class="row">
      <div class="sidebar-wrapper col-md-4 col-sm-12 col-xs-12">
         <aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="">
            <div class="close-sidebar-btn hidden-lg hidden-md"> <i class="ti-close"></i> <span>Close</span></div>
            <aside class="widget widget_apus_elementor_template">
               <div data-elementor-type="page" data-elementor-id="1402" class="elementor elementor-1402">
                  <section class="elementor-section elementor-top-section elementor-element elementor-element-baf6774 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="baf6774" data-element_type="section">
                     <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-a805ad2" data-id="a805ad2" data-element_type="column">
                           <div class="elementor-widget-wrap elementor-element-populated">
                              <div class="elementor-element elementor-element-02873bf elementor-widget elementor-widget-apus_element_job_board_pro_search_form" data-id="02873bf" data-element_type="widget" data-widget_type="apus_element_job_board_pro_search_form.default">
                                 <div class="elementor-widget-container">
                                    <div class="widget-job-search-form ">
                                       <form action="" class="form-search filter-listing-form-wrapper" method="GET">
                                          <div class="filter-listing-form vertical">
                                             <div class="main-inner clearfix">
                                                <div class="content-main-inner">
                                                   <div class="row">
                                                      <div class="col-xs-12 col-md-12 has-border">
                                                         <div class="form-group form-group-title  ">
                                                            <label for="LiZQ5_title" class="heading-label">Search by Keywords</label>
                                                            <div class="form-group-inner inner has-icon">
                                                               <i class="flaticon-magnifiying-glass"></i>
                                                               <?php $Jobtitle = isset($_GET['filter-title']) ? trim($_GET['filter-title']) : ''; ?>
                                                               <input type="text" name="filter-title" class="form-control" value="<?php echo $Jobtitle; ?>" id="LiZQ5_title" placeholder="Job title, keywords...">
                                                            </div>
                                                         </div>
                                                         <!-- /.form-group -->
                                                      </div>
                                                      <div class="col-xs-12 col-md-12 ">
                                                         <div class="form-group form-group-center-location  ">
                                                            <label for="LiZQ5_center-location" class="heading-label">Location</label>
                                                            <div class="form-group-inner inner has-icon">
                                                               <i class="flaticon-location"></i>
                                                               <div class="action-location">
                                                                  <?php $FilterLocation = isset($_GET['filter-location']) ? trim($_GET['filter-location']) : ''; ?>
                                                                  <input type="text" name="filter-location" class="form-control pac-target-input" value="<?php echo $FilterLocation; ?>" id="LiZQ5_center-location" placeholder="City or postcode" autocomplete="off">
                                                                  <span class="find-me"></span>
                                                                  <span class="clear-location hidden"><i class="ti-close"></i></span>
                                                               </div>
                                                               <input type="hidden" name="filter-center-latitude" value="">
                                                               <input type="hidden" name="filter-center-longitude" value="">
                                                            </div>
                                                         </div>
                                                         <!-- /.form-group -->
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="wrapper-submit flex-middle col-xs-12 col-md-12">
                                                   <button class="btn-submit btn btn-theme btn-inverse" type="submit">
                                                      Find Jobs </button>
                                                </div>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
            </aside>
         </aside>
      </div>

      <?php

      $page_no = isset($_GET['page_no']) ? intval($_GET['page_no']) : 1;
      $total_elements = count($featured_jobs);

      function paginationUrlBuilder($pn, $dont_modify = false)
      {
         $custom_get_array = [];
         foreach ($_GET as $k => $v) {
            if ($k == 'page_no') {
               $custom_get_array[$k] = $dont_modify ? $pn : $v + $pn;
            } else {
               $custom_get_array[$k] = $v;
            }
         }
         if (!isset($custom_get_array['page_no'])) {
            $custom_get_array['page_no'] = $dont_modify ? $pn : 1 + $pn;
         }
         if ($custom_get_array['page_no'] == 0) {
            $custom_get_array['page_no'] = 1;
         }
         $query = build_query($custom_get_array);
         return $query;
      }

      if ($featured_jobs) {

         $start_element = ($page_no - 1) * 10;
         $end_element = ($total_elements < ($page_no * 10)) ? $total_elements : ($page_no * 10);

      ?>

         <div id="main-content" class="col-sm-12 col-md-8 col-sm-12 col-xs-12" style="width:100%">
            <main id="main" class="site-main layout-type-default" role="main">
               <div class="jobs-listing-wrapper main-items-wrapper" data-display_mode="list">
                  <div class="jobs-alert-ordering-wrapper">
                     <div class="results-count">
                        Showing <span class="first"><?php echo $start_element + 1; ?></span> – <span class="last"><?php echo $end_element; ?></span> of <?php echo $total_elements; ?> results
                     </div>

                  </div>

                  <?php for ($y = $start_element; $y < $end_element; $y++) { ?>

                     <div class="jobs-wrapper items-wrapper">
                        <div class="row items-wrapper-list">
                           <a href="?www=<?php echo $featured_jobs[$y]->RefCode; ?>">
                              <div class="item-job col-sm-12 col-md-12 col-xs-12 lg-clearfix md-clearfix ">
                                 <article id="post-4540" class="map-item layout-job job-list default post-4540 job_listing type-job_listing status-publish hentry job_listing_type-full-time job_listing_category-design job_listing_category-development job_listing_location-new-york job_listing_tag-app job_listing_tag-jobs job_listing_tag-superio job_listing_tag-support is-featured is-urgent" data-latitude="40.69865478041131" data-longitude="-73.99426069264436" data-img="https://apusthemes.com/wp-demo/superio-new/wp-content/uploads/2021/05/y2.jpg">
                                    <div class="clearfix">
                                       <div class="employer-logo">
                                          <img width="100" height="100" src="https://apusthemes.com/wp-demo/superio-new/wp-content/uploads/2021/05/y2.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">
                                       </div>
                                       <div class="job-list-content">
                                          <div class="title-wrapper flex-middle-sm">
                                             <h2 class="job-title"><?php echo $featured_jobs[$y]->JobTitle; ?></h2>
                                             <span class="featured-text"><?php echo $featured_jobs[$y]->ContractType; ?></span>
                                          </div>
                                          <div class="job-metas">
                                             <div class="category-job">
                                                <i class="flaticon-briefcase-1"></i>
                                                <?php echo $featured_jobs[$y]->JobType; ?>
                                             </div>
                                             <div class="job-location">
                                                <i class="flaticon-location"></i>
                                                <?php echo $featured_jobs[$y]->RegionCity; ?>
                                             </div>
                                          </div>
                                          <div class="job-metas-bottom">
                                             <?php if ($featured_jobs[$y]->PositionType == true) { ?>
                                                <div class="job-type with-title">
                                                   <span class="type-job" href="" style=""><?php echo $featured_jobs[$y]->PositionType ?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if ($featured_jobs[$y]->IsPaid == true) { ?>
                                                <span class="urgent"><?php echo $featured_jobs[$y]->IsPaid ?> </span>
                                             <?php } ?>
                                          </div>
                                       </div>
                                    </div>
                                 </article>
                              </div>
                           </a>
                        </div>
                     </div>

                  <?php } ?>

               </div>
            </main>
         </div>

         <?php if (($total_elements / 10) > 1) : ?>
            <div class="jobs-pagination-wrapper main-pagination-wrapper">
               <ul class="pagination">

                  <?php if ($page_no != 1) : ?>
                     <li><a class="next page-numbers" href="?<?php echo paginationUrlBuilder(-1); ?>"><i class="ti-arrow-left"></i></a></li>
                  <?php endif; ?>

                  <?php for ($x = 1; $x <= $total_elements / 10 + 1; $x++) { ?>
                     <li>
                        <a class="page-numbers <?php echo ($page_no === $x ? 'current' : ''); ?>" href="?<?php echo paginationUrlBuilder($x, true); ?>">
                           <?php echo $x; ?>
                        </a>
                     </li>
                  <?php }

                  if ($page_no != floor($total_elements / 10) + 1) { ?>
                     <li>
                        <a class="next page-numbers" href="?<?php echo paginationUrlBuilder(1); ?>">
                           <i class="ti-arrow-right"></i>
                        </a>
                     </li>
                  <?php } ?>
               </ul>
            </div>
         <?php endif; ?>

      <?php } ?>

   </div>
</div>
</div>
