<?php
/**
 * Created by PhpStorm.
 * User: jbritts
 * Date: 11/9/17
 * Time: 3:01 PM
 */

namespace MagentoEse\Wysiwygdesign\Model;


class CssContent
{
    protected $skinDirectory ='/static/frontend/Magento/luma/en_US/MagentoEse_Wysiwygdesign/css/';
    protected $cssFilename = 'demo.css';

    public function __construct(
        \MagentoEse\Wysiwygdesign\Helper\Data $helperData,
        \MagentoEse\Wysiwygdesign\Model\Deploy $deploy
    ) {
        $this->helperData = $helperData;
        $this->deploy = $deploy;
    }
    public function generateCssContent()
    {
        $helper = $this->helperData;

        //define configs
        $top_bar_color = $helper->getTopBarColor();
        $primary_font_color = $helper->getPrimaryFontColor();
        $primary_link_color = $helper->getPrimaryLinkColor();
        $primary_link_hover_color = $helper->getPrimaryLinkHoverColor();
        $primary_heading_color = $helper->getPrimaryHeadingColor();
        $primary_price_color = $helper->getPrimaryPriceColor();
        $background_color = $helper->getBackgroundColor();
        $category_grid_background_color = $helper->getCategoryGridBackgroundColor();
        $product_view_background_color = $helper->getProductViewBackgroundColor();
        $block_content_background_color = $helper->getBlockContentBackgroundColor();
        $nav_background_color = $helper->getNavBackgroundColor();
        $nav_link_color = $helper->getNavLinkColor();
        $nav_link_hover_color = $helper->getNavLinkHoverColor();
        $nav_dropdown_background_color = $helper->getNavDropdownBackgroundColor();
        $nav_dropdown_link_color = $helper->getNavDropdownLinkColor();
        $nav_dropdown_link_hover_color = $helper->getNavDropdownLinkHoverColor();
        $button_background_color = $helper->getButtonBackgroundColor();
        $button_link_color = $helper->getButtonLinkColor();
        $button_link_hover_color = $helper->getButtonLinkHoverColor();

        //logo assets
        $asset_logo = $helper->getAssetLogo();

        $additional_css = $helper->getAdditionalCSS();

        //future : switch statement based on param for design / css profile
        //will support LUMA and default EE theme

        //build content
        $css_content = '/* THIS FILE IS AUTO-GENERATED, DO NOT MAKE MODIFICATIONS DIRECTLY */' . "\n";
        $css_content .= '.header-language-background { background-color:' . $top_bar_color . ';}' . "\n";
        $css_content .= 'body { color:' . $primary_font_color . ';}' . "\n";
        $css_content .= 'a { color:' . $primary_link_color . '!important;}' . "\n";
        $css_content .= 'a:hover { color:' . $primary_link_hover_color . '!important;}' . "\n";
        $css_content .= '.no-touch .product-image:hover {border-color:'.$primary_link_hover_color. '!important}'."\n";

        $css_content .= 'h1,h2,h3,h4,h5,h6,h7, .product-name .h1, .block-title h2, .block-title h3, .block-title strong, .footer .block-title, .footer address{ color:' . $primary_heading_color . '!important;}' . "\n";
        $css_content .= '.price-box .price { color:' . $primary_price_color . '!important;}';
        $css_content .= 'body, .wrapper, .skip-link { background-color:' . $background_color . '!important;}' . "\n";
        $css_content .= '.category-products{ background-color:' . $category_grid_background_color . '!important;}' . "\n";
        $css_content .= '.product-view{ background-color:' . $product_view_background_color . '!important;}' . "\n";
        $css_content .= '.block-content{ background-color:' . $block_content_background_color . '!important;}' . "\n";
        $css_content .= '.nav-primary { background-color:' . $nav_background_color . '!important;}' . "\n";
        $css_content .= '.nav-primary a { color:' . $nav_link_color . '!important;}' . "\n";
        $css_content .= '.nav-primary a:hover { color:' . $nav_link_hover_color . '!important;}' . "\n";
        $css_content .= '.nav-primary li.level0 ul  { background-color:' . $nav_dropdown_background_color . '!important;}' . "\n";
        $css_content .= '.nav-primary li.level1 a  { color:' . $nav_dropdown_link_color . '!important;}' . "\n";
        $css_content .= '.nav-primary li.level1 a:hover  { color:' . $nav_dropdown_link_hover_color . '!important;}' . "\n";
        $css_content .= '.button, .cart-table .product-cart-actions .button, #co-shipping-method-form .buttons-set .button, .footer .button  { background-color:' . $button_background_color . '!important;}' . "\n";

        $css_content .= 'a.button  { color:' . $button_link_color . '!important;}' . "\n";
        $css_content .= 'a.button:hover  { color:' . $button_link_hover_color . '!important;}' . "\n";
        $css_content .= '.input-text:focus {border-color:'.$button_background_color. '!important}'."\n";
        $css_content .= '.slideshow-next:hover:before {border-color:transparent transparent transparent '.$button_background_color. '!important}'."\n";
        $css_content .= '.slideshow-pager span.cycle-pager-active:before, .slideshow-pager span:hover:before { background-color:'.$button_background_color. '!important}'."\n";

        if($helper->getAssetLogo()){
            $css_content .= '.logo img {display:none!important;}'."\n";
            $css_content .= '.logo {background: url('.$asset_logo.') top left no-repeat!important; min-width:300px; min-height:90px; max-width:300px!important; max-height:90px!important;}'."\n";
        }

        //misc fixes
        $css_content .= 'button.search-button { background:none repeat scroll 0 0 rgba(0, 0, 0, 0)!important;}' . "\n";
        //$css_content .= '.minicart-actions .checkout-button { background-color:#3399cc!important; color:#fff;}' . "\n";

        $css_content .= $additional_css;

        return $css_content;
    }
    public function createCSSFile($contents)
    {
        if ($contents != NULL) {

            $filename = '';
            $filename = $_SERVER['DOCUMENT_ROOT'].$this->skinDirectory . $this->cssFilename;
            //$filename = str_replace("pub","",$_SERVER['DOCUMENT_ROOT']).$filename;

            if (!file_exists($filename)) {
                mkdir($_SERVER['DOCUMENT_ROOT'].$this->skinDirectory,0744,true);
                $fh = fopen($filename, 'w');
                fclose($fh);
            }
            //reset the file
            file_put_contents($filename, "");

            //create new file and prep for insertion
            $current = file_get_contents($filename);
            $current .= $contents;

            //rewrite it out
            file_put_contents($filename, $current);

            //check if in production mode. Then do a quick static deploy
            $this->deploy->staticContentDeploy();

        }
    }

}