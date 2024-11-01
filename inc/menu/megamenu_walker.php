<?php

/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/

class Themereps_Helper_Nav_Walker extends Walker_Nav_Menu
{
 
  public $mega_Menu ='';
  public $megadiv ='';
  public $bc_CLM ='';

  public function start_lvl( &$output,  $depth = 0, $args = array() ) {
	$Mlas ='';
    $indent = str_repeat("\t", $depth);
    if( $depth === 0 &&  $this->mega_Menu == "yes"){
      if($this->bc_CLM=='50%'){
        $Mwd = '460px';
        $Mlas = 'two-column mega-center';
      }elseif($this->bc_CLM=='33%'){
        $Mwd = '620px';
        $Mlas = 'three-column mega-center';
	  } elseif($this->bc_CLM=='25%'){
        $Mwd = '100%';
        $Mlas = 'four-column full-width';
	  } elseif($this->bc_CLM=='20%') { 
        $Mwd = '100%';
        $Mlas = 'five-column full-width';
      }else{
        $Mwd = '';
      }

      $output .= "\n$indent<ul class=\"mega-menu sub-menu $Mlas\" style=\"width:$Mwd;\">\n";
    }else{
      $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	 
    if($item->megamenu == 'enabled'){
        $this->mega_Menu = 'yes';
    }else{
        $this->mega_Menu = 'no';
    }

    if($depth === 0 && $this->mega_Menu=='no'){
        $edifice_cls = 'nocls';
    }else{
        $edifice_cls = 'mega-col';
    }

     $class_names = $value = '';
     $classes = empty( $item->classes ) ? array() : (array) $item->classes;
     $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
     $class_names = ' class="'. esc_attr( $class_names ).' '.$edifice_cls . '"';
	 
    if($item->column){
        $this->bc_CLM = $item->column;
    }
    if($depth ==1){
		$output .= $indent . '<li' . $value . $class_names .'>';
   }else{
		$output .= $indent . '<li' . $value . $class_names .'>';
   }
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$prepend = '';
		$append = '';
		$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

		$ttl_disable = '';
		$menu_ico = '';
		$menu_ficon = '';
		$menu_aspan = '';
		$menu_bspan = '';
		$mega_ttlc = '';  
		$edifice_drop = '';
    if($item->ficon){
        $menu_ico = $item->ficon;
    }
     if($depth != 0)
     {
		$description = $append = $prepend = "";
		$menu_aspan ='<span>';
		$menu_bspan ='</span>';
     }
     if($item->disablet){
        $ttl_disable=1;
     }
     if( $depth ==1 && $ttl_disable!=1){
        $mega_ttlc='menu-title';
     }elseif( $depth ==1 && $ttl_disable==1){
        $mega_ttlc='ttl-hd-cls';
     }
    if ( $args->has_children && $depth === 0){
       $edifice_drop = '';
    }else{
      $edifice_drop = '';
    }
      if(isset($menu_ico)){
        $menu_ficon ='<i class="'.$menu_ico. '"></i>';
        if(empty($menu_ico)){
          $menu_ficon = '';
        }
      }
      $item_output = $args->before;
      if($ttl_disable!=1){
        $item_output .= '<a'. $attributes .' class="'.$mega_ttlc.'">';
        $item_output .= $menu_ficon. $menu_aspan;
        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
        $item_output .= $menu_bspan;
        $item_output .= $description.$args->link_after;
        $item_output .= ' '.$item->subtitle.$edifice_drop.'</a>';
      }
      $item_output .= $args->after;
      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
  public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
      $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ){
           $args[0]->has_children =  !empty ( $children_elements[ $element->$id_field ] ) ;
        }
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add Menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo wp_kses_post($fb_output);
		} else{ 					extract( $args );			$fb_output = null;			if ( $container ) {				$fb_output = '<' . $container;				if ( $container_id )					$fb_output .= ' id="' . $container_id . '"';				if ( $container_class )					$fb_output .= ' class="' . $container_class . '"';				$fb_output .= '>';			}			$fb_output .= '<ul';			if ( $menu_id )				$fb_output .= ' id="' . $menu_id . '"';			if ( $menu_class )				$fb_output .= ' class="' . $menu_class . '"';			$fb_output .= '>';			$fb_output .= '<li><a href="' . get_home_url() . '">Home</a></li>';			$fb_output .= '</ul>';			if ( $container )				$fb_output .= '</' . $container . '>';			echo $fb_output;						}
	}
}