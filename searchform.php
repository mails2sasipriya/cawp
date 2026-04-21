<form id="Search"
      role="search"
      method="get"
      class="pos-rel"
      action="<?php echo home_url('/'); ?>">

  <span class="sr-only" id="SearchInput">Search</span>

  <input type="search"
         name="s"
         aria-labelledby="SearchInput"
         placeholder="Search"
         class="search-textfield"
         value="<?php echo get_search_query(); ?>">

  <button type="submit" class="gsc-search-button">
    <span class="ca-gov-icon-search" aria-hidden="true"></span>
    <span class="sr-only">Submit</span>
  </button>

  <div class="close-search-btn">
    <button type="reset"
            class="close-search gsc-clear-button border-0 bg-transparent pos-rel">
      <span class="sr-only">Close</span>
    </button>
  </div>

</form>