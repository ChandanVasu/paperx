<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="search-box">
        <input type="search" class="search-field" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="search-box-search-submit">Search</button>
    </div>
</form>
