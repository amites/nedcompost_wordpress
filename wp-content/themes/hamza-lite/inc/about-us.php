<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create about us content
 */
 class About_Us extends WP_Customize_Control
 {
    
    /**
     * Render the content of about us
     *
     * @return HTML
     */
    public function render_content()
       {
            $eightdegree_link = esc_url('http://8degreethemes.com');
            $hamza_lite = esc_url('https://8degreethemes.com/hamza-lite/');
            $doc_link = esc_url('https://8degreethemes.com/theme-instruction-hamza-lite/');
            $support = esc_url('http://8degreethemes.com/support/');
            $return = '<p>';
            $return .= __('Hamza Lite - is a FREE WordPress theme by', 'hamza_lite'); 
            $return .= '<a target="_blank" href="'.$eightdegree_link.'">';
            $return .= __(' 8Degree Themes ', 'hamza_lite');
            $return .= '</a>'; 
            $return .= '- A WordPress Division of 8Degree.</p>';            
            echo $return;
       }
 }
?>