<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <div class="input-group">
    <input type="text" class="search-field form-control mr-sm-2" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" aria-describedby="search-form"> 
    <button type="submit" class="btn btn-outline-primary my-2 my-sm-0" id="search-form"><?php echo esc_attr_x( 'Search', 'submit button' ) ?></button>  
  </div>   
</form>