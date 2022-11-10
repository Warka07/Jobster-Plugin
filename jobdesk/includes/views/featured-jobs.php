<!-- <div class="jd-featured-jobs-box" >
    <div class="row" style="  display: flex;flex-wrap: wrap;">
        <?php
        if ( $featured_jobs ) {
            $count = 0;
            foreach ( $featured_jobs as $row ) {
                $count ++;
                if($count == 7) {
                   break;             
                }
                ?>
<a href="/findjobs?jobdesk_ref_code=<?php echo esc_attr( $row->RefCode ); ?>&job_type=<?php echo $row->JobType?>">
                <div class="col-md-6 col-sm-6 col-xs-12  md-clearfix lg-clearfix sm-clearfix">
                   <article id="post-4540" class="map-item layout-job job-list default post-4540 job_listing type-job_listing status-publish hentry job_listing_type-full-time job_listing_category-design job_listing_category-development job_listing_location-new-york job_listing_tag-app job_listing_tag-jobs job_listing_tag-superio job_listing_tag-support is-featured is-urgent" data-latitude="40.69865478041131" data-longitude="-73.99426069264436" data-img="#"
                   style="height:170px">
                  
     <div class="clearfix">
         <div class="employer-logo">
            <img loading="lazy" width="100" height="100" src="https://apusthemes.com/wp-demo/superio-new/wp-content/uploads/2021/05/y10.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">            	              
         </div>
         <div class="job-list-content">
            <div class="title-wrapper flex-middle-sm">
               <h2 class="job-title">
                <p href="?jobdesk_ref_code=<?php echo esc_attr( $row->RefCode ); ?>&ppp=<?php echo $row->JobType?>&newdata=<?php echo $row->RegionCity?> "  rel="bookmark"><?php echo esc_html( $row->JobTitle );?></p>
                </h2>
               
            </div>
            <div class="job-metas" style="margin-top:-14px;">
               <div class="category-job">
                  <div class="job-category with-icon">
                     <i class="flaticon-briefcase-1"></i>
                     <span href=""><?php echo esc_html( $row->JobType );?></span> 
                  </div>
               </div>
               <div class="job-location">
                
                  <i class="flaticon-location"></i>
                                <?php echo esc_html( $row->RegionCity );?>                   
               </div>
               <div class="job-deadline with-icon"><i class="flaticon-wall-clock"></i> <?php echo date_i18n( "d-m-Y", strtotime( $row->Published) ); ?></div>
            </div>
            <div class="job-metas-bottom">
               <div class="job-type with-title">
                  <?php if ($row->PositionType == true) { ?>
               <p class="type-job" href="" style=""><?php echo esc_html( $row->PositionType );?></p>
               <?php } ?>
               </div>
            
               <span class="urgent"><?php echo esc_html( $row->ContractType );?></span>

               <?php
                        if ( $row->IsPaid == true ) {
                            ?>
                           
                           <p class="type-job"><?php esc_html_e( "Paid", "jobdesk" );?></p>
                            </div>
                            <?php
                        }
                        ?>  
            </div>
         </div>
      </div>
   </article>
 </a>
</div>
                
                <?php
                
            }
        }
        ?>
         
    </div>
</div> -->


<section class="mt-100 pt-100 pb-100" style="background-color: #fff8ec">
   <div class="pxp-container">
      <h2 class="pxp-section-h2 ">
         Featured Job Offers
      </h2>
      <p class="pxp-text-light ">
         Search your career opportunity through 12,800 jobs
      </p>
      <!-- <div class="warka"  style="display: flex;flex-wrap: wrap;"> -->
      <?php
        if ( $featured_jobs ) {
            $count = 0;
            foreach ( $featured_jobs as $row ) {
                $count ++;
                if($count == 7) {
                   break;             
                }
                ?>
                <a href="/findjobs?jobdesk_ref_code=<?php echo esc_attr( $row->RefCode ); ?>&job_type=<?php echo $row->JobType?>">
      <div class="row mt-4 mt-md-5 pxp-animate-in pxp-animate-in-top pxp-in ">
    
         <div class="col-md-6 col-xl-4 col-xxl-3 pxp-jobs-card-1-container">
       
            <div class="pxp-jobs-card-1 pxp-has-shadow">
               <div class="pxp-jobs-card-1-top">
                  <span href="" class="pxp-jobs-card-1-category">
                     <div class="pxp-jobs-card-1-category-icon">
                        <span class="fa fa-line-chart"></span>
                     </div>
                     <div class="pxp-jobs-card-1-category-label">
                     <?php echo esc_html( $row->ContractType );?>
                     </div>
                  </span>
                  <span href="?jobdesk_ref_code=<?php echo esc_attr( $row->RefCode ); ?>&ppp=<?php echo $row->JobType?>&newdata=<?php echo $row->RegionCity?> " class="pxp-jobs-card-1-title"><?php echo esc_html( $row->JobTitle );?>
                  <!-- <p href="?jobdesk_ref_code=<?php echo esc_attr( $row->RefCode ); ?>&ppp=<?php echo $row->JobType?>&newdata=<?php echo $row->RegionCity?> "  rel="bookmark"><?php echo esc_html( $row->JobTitle );?></p> -->
                  </span>
                  <div class="pxp-jobs-card-1-details">
                     <p  class="pxp-jobs-card-1-location">
                     <span class="fa fa-globe"></span>
                     <?php echo esc_html( $row->RegionCity );?> 
                     </p>
                     <div class="pxp-jobs-card-1-type">
                     <?php echo esc_html( $row->JobType );?>
                     </div>
                  </div>
               </div>
               <div class="pxp-jobs-card-1-bottom">
                  <div class="pxp-jobs-card-1-bottom-left">
                     <div class="pxp-jobs-card-1-date pxp-text-light">
                        <?php echo date_i18n( "d-m-Y", strtotime( $row->Published) ); ?><span class="d-inline">
                        <!-- by -->
                        </span>
                     </div>
                     <p href="" class="pxp-jobs-card-1-company">
                     <?php echo esc_html( $row->PositionType );?>
                     </p>
                  </div>
                  <span href="" class="pxp-jobs-card-1-company-logo" style="background-image: url(https://pixelprime.co/themes/jobster-wp/demo-1/wp-content/uploads/2022/06/company-logo-5-160x160.png);"></span>
               </div>
            </div>
         </div>
      </div>
         </a>
      <?php
                
               }
           }
           ?>
           <!-- </div> -->
      <div class="mt-4 mt-md-5 pxp-animate-in pxp-animate-in-top pxp-in">
         <a href="/find-jobs/" class="btn rounded-pill pxp-section-cta">
         All Job Offers
         <span class="fa fa-angle-right"></span>
         </a>
      </div>
     
   </div>
</section>