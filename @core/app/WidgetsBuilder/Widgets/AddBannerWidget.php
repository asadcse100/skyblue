<?php

namespace App\WidgetsBuilder\Widgets;


use App\Models\Blog;
use App\Models\BlogCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\Models\Language;
use App\PageBuilder\Fields\DatePicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\Models\Widgets;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class AddBannerWidget extends WidgetBase
{
    use LanguageFallbackForPageBuilder;
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();


        $output .= Image::get([
            'name' => 'image',
            'label' => __('Add Banner'),
            'value' => $widget_saved_values['image'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'image_url',
            'label' => __(' Image Url'),
            'value' => $widget_saved_values['image_url'] ?? null,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $image_id = SanitizeInput::esc_html($this->setting_item('image'));
        $image_url = SanitizeInput::esc_html($this->setting_item('image_url'));
        $image_markup = render_image_markup_by_attachment_id($image_id,null,'full');

        $markup = $this->widget_before();
    $markup .=  <<<HTML

        <div class="widget">
            <div class="adds style-01">
               <a href="{$image_url}">
                    {$image_markup}
                    </a>
            </div>
        </div>
HTML;
        $markup .= $this->widget_after();
   return $markup;
    }

    public function widget_title(){
        return __('Banner : 01');
    }

}