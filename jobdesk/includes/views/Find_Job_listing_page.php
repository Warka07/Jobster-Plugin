<section class="pxp-page-header-simple" style="background-color: var(--pxpMainColorLight);">
   <div class="pxp-container">
      <!-- <h1 class="">
         Jobs        
      </h1> -->
      <div class="pxp-hero-subtitle pxp-text-light ">
         Search your career opportunity through 12,800 jobs        
      </div>
      <div class="pxp-hero-form pxp-hero-form-round pxp-large mt-3 mt-lg-4">
         <form id="nhr-job-searching-form" class="row gx-3 align-items-center" role="search" method="GET" 
         action="/findjobs/">
            <!-- <form action="/findjobs/" id="nhr-job-searching-form" class="form-search filter-listing-form-wrapper" method="GET" > -->

            <input type="hidden" name="sort" id="sort" value="newest" autocomplete="off">
            <input type="hidden" name="type" id="type" value="">
            <input type="hidden" name="level" id="level" value="">
            <div class="col-12 col-lg">
               <!-- Keywords field -->
               <div class="input-group mb-3 mb-lg-0">
                  <span class="input-group-text">
                  <span class="fa fa-search"></span>
                  </span>
                  <!-- <input type="text" name="keywords" id="keywords" class="form-control" value="" placeholder="Job Title or Keyword"> -->
                  <i class="flaticon-magnifiying-glass"></i>
                  <?php $Jobtitle = isset($_GET['filter-title']) ? trim($_GET['filter-title']) : ''; ?>
                           <input type="text" name="filter-title" class="form-control " value="<?php echo $Jobtitle; ?>"id="nhr-job-searching-form-title" placeholder="Job title...">
               </div>
            </div>
            <div class="col-12 col-lg pxp-has-left-border">
               <!-- Location field -->
               <div class="input-group mb-3 mb-lg-0">
                  <span class="input-group-text">
                  <span class="fa fa-globe"></span>
                  </span>
                  <!-- <select class="form-select" name="location" id="location"> -->
                  <?php $FilterLocation = isset($_GET['filter-location']) ? trim($_GET['filter-location']) : ''; ?>
                                        <input type="text" name="filter-location" class="form-control" value="<?php echo $FilterLocation; ?>" id="nhr-job-searching-form-location" placeholder="Region">
                                     <!-- </select> -->
               </div>
            </div>
            <div class="col-12 col-lg pxp-has-left-border">
               <!-- Category field -->
               <div class="input-group mb-3 mb-lg-0">
                  <span class="input-group-text">
                  <span class="fa fa-folder-o"></span>
                  </span>
                 <!--  -->
                 <i class="flaticon-briefcase-1"></i>
                           <select name="filter-contract-type" id="nhr-job-searching-form-contract-type" class="form-control pac-target-input">
                                       <option value="">
                                          Select Contract Type
                                       </option>
                                       <?php
                                       $FilterContractType = isset($_GET['filter-contract-type']) ? trim($_GET['filter-contract-type']) : '';
                                       foreach (get_contract_types() as $ContractType) :
                                          if (empty($ContractType->Value)) {
                                             continue;
                                          }
                                       ?>
                                          <option <?php echo (($FilterContractType == $ContractType->Code) ? 'selected' : ''); ?> value="<?php echo $ContractType->Code; ?>">
                                             <?php echo $ContractType->Value; ?>
                                          </option>
                                       <?php endforeach ?>
                                    </select>
       
               </div>
            </div>

            <div class="col-12 col-lg pxp-has-left-border">
               <!-- Category field -->
               <div class="input-group mb-3 mb-lg-0">
                  <span class="input-group-text">
                  <span class="fa fa-folder-o"></span>
                  </span>
                 <i class="flaticon-briefcase-1"></i>
                 <select name="filter-sector" id="nhr-job-searching-form-sector" class="form-control pac-target-input">
                                       <option value="">
                                       Select Sector
                                       </option>
                                       <?php
                                       $FilterSector = isset($_GET['filter-sector']) ? trim($_GET['filter-sector']) : '';
                                       foreach (get_sectors() as $Sector) :
                                          if (empty($Sector->Value)) {
                                             continue;
                                          }
                                       ?>
                                          <option <?php echo (($FilterSector == $Sector->Code) ? 'selected' : ''); ?> value="<?php echo $Sector->Code; ?>">
                                             <?php echo $Sector->Value; ?>
                                          </option>
                                       <?php endforeach ?>
                                       </select>
               </div>
            </div>
            <!--  -->
            <div class="col-12 col-lg-auto">
               <button class="btn-submit btn btn-theme btn-inverse" type="submit" id="nhr-job-searching-form-submit-btn">Find Jobs</button>
            </div>
         </form>
      </div>
   </div>
</section>
<!--  -->

<!--  -->
<div class="col-lg-7 col-xl-8 col-xxl-9 ">
   <div class="pxp-jobs-list-top mt-4 mt-lg-0">
      <div class="row justify-content-between align-items-center">
         <div class="col-auto">
            <h2>
               <span class="pxp-text-light">Showing</span> 
               16 
               <span class="pxp-text-light">jobs</span>
            </h2>
         </div>
         <!-- <div class="col-auto">
            <select class="form-select" id="pxp-sort-jobs">
               <option value="newest" selected="selected">
                  Newest                                
               </option>
               <option value="oldest">
                  Oldest                                
               </option>
            </select>
         </div> -->
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-lg-12 col-xl-6 col-xxl-4 pxp-jobs-card-1-container">
         <div class="pxp-jobs-card-1 pxp-has-border">
            <div class="pxp-jobs-card-1-top">
               <a href="https://pixelprime.co/themes/jobster-wp/demo-1/jobs-list/?category=24" class="pxp-jobs-card-1-category">
                  <div class="pxp-jobs-card-1-category-icon">
                     <span class="fa fa-cubes"></span>
                  </div>
                  <div class="pxp-jobs-card-1-category-label">
                     Construction                                                    
                  </div>
               </a>
               <a href="https://pixelprime.co/themes/jobster-wp/demo-1/jobs/agiota/" class="pxp-jobs-card-1-title">
               Agiota                                            </a>
               <div class="pxp-jobs-card-1-details">
                  <a href="https://pixelprime.co/themes/jobster-wp/demo-1/jobs-list/?location=16" class="pxp-jobs-card-1-location">
                  <span class="fa fa-globe"></span>
                  Chicago, IL                                                    </a>
                  <div class="pxp-jobs-card-1-type">
                     Contract                                                    
                  </div>
               </div>
            </div>
            <div class="pxp-jobs-card-1-bottom">
               <div class="pxp-jobs-card-1-bottom-left">
                  <div class="pxp-jobs-card-1-date pxp-text-light">
                     October 30, 2022                                                        <span class="d-inline">
                     by                                                        </span>
                  </div>
                  <a href="https://pixelprime.co/themes/jobster-wp/demo-1/companies/farlindo/" class="pxp-jobs-card-1-company">
                  Farlindo                                                    </a>
               </div>
               <a href="https://pixelprime.co/themes/jobster-wp/demo-1/companies/farlindo/" class="pxp-jobs-card-1-company-logo pxp-no-img">
               F                                                    </a>
            </div>
         </div>
      </div>

   <div class="row mt-4 mt-lg-5 justify-content-between align-items-center">
      <div class="col-auto">
         <nav class="mt-3 mt-sm-0" aria-label="Pagination">
            <ul class="pagination pxp-pagination">
               <li class="page-item active">
                  <a class="page-link" href="#">
                  1                                            </a>
               </li>
               <li class="page-item">
                  <a class="page-link" href="https://pixelprime.co/themes/jobster-wp/demo-1/jobs-list/page/2/">
                  2                                            </a>
               </li>
            </ul>
         </nav>
      </div>
      <div class="col-auto pxp-next-page-link mt-3 mt-sm-0">
         <a href="https://pixelprime.co/themes/jobster-wp/demo-1/jobs-list/page/2/">
            <div class="btn rounded-pill pxp-section-cta">Show me more<span class="fa fa-angle-right"></span>
            </div>
         </a>
      </div>
   </div>
</div>