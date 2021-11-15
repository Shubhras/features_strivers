<?php
/**
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Models\Setting;

use App\Models\Setting\Traits\WysiwygEditorsTrait;

class SingleSetting
{
	use WysiwygEditorsTrait;
	
	public static function getValues($value, $disk)
	{
		if (empty($value)) {
			
			$value['publication_form_type'] = '1';
			$value['picture_mandatory'] = '1';
			$value['pictures_limit'] = '5';
			$value['title_min_length'] = '2';
			$value['title_max_length'] = '150';
			$value['description_min_length'] = '5';
			$value['description_max_length'] = '6000';
			$value['tags_limit'] = '15';
			$value['tags_min_length'] = '2';
			$value['tags_max_length'] = '30';
			$value['guests_can_post_ads'] = '1';
			$value['guests_can_contact_ads_authors'] = '1';
			$value['permanent_posts_enabled'] = '0';
			$value['auto_registration'] = '0';
			$value['wysiwyg_editor'] = 'tinymce';
			$value['pictures_slider'] = 'horizontal-thumb';
			$value['similar_posts'] = '1';
			$value['similar_posts_limit'] = '12';
			$value['similar_posts_in_carousel'] = '1';
			
		} else {
			
			if (!isset($value['publication_form_type'])) {
				$value['publication_form_type'] = '1';
			}
			if (!isset($value['picture_mandatory'])) {
				$value['picture_mandatory'] = '1';
			}
			if (!isset($value['pictures_limit'])) {
				$value['pictures_limit'] = '5';
			}
			if (!isset($value['title_min_length'])) {
				$value['title_min_length'] = '2';
			}
			if (!isset($value['title_max_length'])) {
				$value['title_max_length'] = '150';
			}
			if (!isset($value['description_min_length'])) {
				$value['description_min_length'] = '5';
			}
			if (!isset($value['description_max_length'])) {
				$value['description_max_length'] = '6000';
			}
			if (!isset($value['tags_limit'])) {
				$value['tags_limit'] = '15';
			}
			if (!isset($value['tags_min_length'])) {
				$value['tags_min_length'] = '2';
			}
			if (!isset($value['tags_max_length'])) {
				$value['tags_max_length'] = '30';
			}
			if (!isset($value['guests_can_post_ads'])) {
				$value['guests_can_post_ads'] = '1';
			}
			if (!isset($value['guests_can_contact_ads_authors'])) {
				$value['guests_can_contact_ads_authors'] = '1';
			}
			if (!isset($value['permanent_posts_enabled'])) {
				$value['permanent_posts_enabled'] = '0';
			}
			if (!isset($value['auto_registration'])) {
				$value['auto_registration'] = '0';
			}
			if (!isset($value['wysiwyg_editor'])) {
				$value['wysiwyg_editor'] = 'tinymce';
			}
			if (!isset($value['pictures_slider'])) {
				$value['pictures_slider'] = 'horizontal-thumb';
			}
			if (!isset($value['similar_posts'])) {
				$value['similar_posts'] = '1';
			}
			if (!isset($value['similar_posts_limit'])) {
				$value['similar_posts_limit'] = '12';
			}
			if (!isset($value['similar_posts_in_carousel'])) {
				$value['similar_posts_in_carousel'] = '1';
			}
			
		}
		
		return $value;
	}
	
	public static function setValues($value, $setting)
	{
		return $value;
	}
	
	public static function getFields($diskName)
	{
		$fields = [
			[
				'name'  => 'publication_sep',
				'type'  => 'custom_html',
				'value' => trans('admin.single_html_publication'),
			],
			[
				'name'              => 'publication_form_type',
				'label'             => trans('admin.publication_form_type_label'),
				'type'              => 'select2_from_array',
				'options'           => [
					1 => trans('admin.publication_form_type_option_1'),
					2 => trans('admin.publication_form_type_option_2'),
				],
				'hint'              => trans('admin.publication_form_type_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'  => 'separator_clear_1',
				'type'  => 'custom_html',
				'value' => '<div style="clear: both;"></div>',
			],
			[
				'name'              => 'title_min_length',
				'label'             => trans('admin.title_min_length_label'),
				'type'              => 'number',
				'attributes'        => [
					'min'  => 0,
					'max'  => 255,
					'step' => 1,
				],
				'hint'              => trans('admin.title_min_length_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-3',
				],
			],
			[
				'name'              => 'title_max_length',
				'label'             => trans('admin.title_max_length_label'),
				'type'              => 'number',
				'attributes'        => [
					'min'  => 1,
					'max'  => 255,
					'step' => 1,
				],
				'hint'              => trans('admin.title_max_length_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-3',
				],
			],
			[
				'name'              => 'description_min_length',
				'label'             => trans('admin.description_min_length_label'),
				'type'              => 'number',
				'attributes'        => [
					'min'  => 0,
					'max'  => 16777215,
					'step' => 1,
				],
				'hint'              => trans('admin.description_min_length_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-3',
				],
			],
			[
				'name'              => 'description_max_length',
				'label'             => trans('admin.description_max_length_label'),
				'type'              => 'number',
				'attributes'        => [
					'min'  => 1,
					'max'  => 16777215,
					'step' => 1,
				],
				'hint'              => trans('admin.description_max_length_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-3',
				],
			],
			[
				'name'              => 'picture_mandatory',
				'label'             => trans('admin.picture_mandatory_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.picture_mandatory_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'pictures_limit',
				'label'             => trans('admin.Pictures Limit'),
				'type'              => 'number',
				'hint'              => trans('admin.pictures_limit_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'tags_limit',
				'label'             => trans('admin.Tags Limit'),
				'type'              => 'number',
				'hint'              => trans('admin.tags_limit_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'tags_min_length',
				'label'             => trans('admin.tags_min_length_label'),
				'type'              => 'number',
				'attributes'        => [
					'min'  => 0,
					'max'  => 16777215,
					'step' => 1,
				],
				'hint'              => trans('admin.tags_min_length_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-3',
				],
			],
			[
				'name'              => 'tags_max_length',
				'label'             => trans('admin.tags_max_length_label'),
				'type'              => 'number',
				'attributes'        => [
					'min'  => 1,
					'max'  => 16777215,
					'step' => 1,
				],
				'hint'              => trans('admin.tags_max_length_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-3',
				],
			],
			[
				'name'  => 'separator_clear_2',
				'type'  => 'custom_html',
				'value' => '<div style="clear: both;"></div>',
			],
			[
				'name'              => 'guests_can_post_ads',
				'label'             => trans('admin.Allow Guests to post Ads'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.guests_can_post_ads_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'posts_review_activation',
				'label'             => trans('admin.Allow Ads to be reviewed by Admins'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.posts_review_activation_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'permanent_posts_enabled',
				'label'             => trans('admin.permanent_posts_label'),
				'type'              => 'select2_from_array',
				'options'           => [
					0 => trans('admin.permanent_posts_option_0'),
					4 => trans('admin.permanent_posts_option_4'),
				],
				'hint'              => trans('admin.permanent_posts_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'pricing_page_enabled',
				'label'             => trans('admin.pricing_page_label'),
				'type'              => 'select2_from_array',
				'options'           => [
					0 => trans('admin.pricing_page_option_0'),
					1 => trans('admin.pricing_page_option_1'),
					2 => trans('admin.pricing_page_option_2'),
				],
				'hint'              => trans('admin.pricing_page_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
		];
		
		if (isUtf8mb4Enabled()) {
			$fields[] = [
				'name'              => 'allow_emojis',
				'label'             => trans('admin.allow_emojis_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.allow_emojis_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			];
		}
		
		$fields = array_merge($fields, [
			[
				'name'              => 'show_post_types',
				'label'             => trans('admin.show_post_types_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.show_post_types_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			
			[
				'name'  => 'auto_registration_sep',
				'type'  => 'custom_html',
				'value' => trans('admin.auto_registration_sep_value'),
			],
			[
				'name'              => 'auto_registration',
				'label'             => trans('admin.auto_registration_label'),
				'type'              => 'select2_from_array',
				'options'           => [
					0 => trans('admin.auto_registration_option_0'),
					1 => trans('admin.auto_registration_option_1'),
					2 => trans('admin.auto_registration_option_2'),
				],
				'hint'              => trans('admin.auto_registration_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			
			[
				'name'  => 'edition_sep',
				'type'  => 'custom_html',
				'value' => trans('admin.edition_sep_value'),
			],
			[
				'name'  => 'wysiwyg_editor_title',
				'type'  => 'custom_html',
				'value' => trans('admin.wysiwyg_editor_title_value'),
			],
			[
				'name'              => 'wysiwyg_editor',
				'label'             => trans('admin.wysiwyg_editor_label'),
				'type'              => 'select2_from_array',
				'options'           => self::wysiwygEditors(),
				'hint'              => trans('admin.wysiwyg_editor_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'  => 'remove_url_title',
				'type'  => 'custom_html',
				'value' => trans('admin.remove_url_title_value'),
			],
			[
				'name'              => 'remove_url_before',
				'label'             => trans('admin.remove_element_before_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.remove_element_before_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'remove_url_after',
				'label'             => trans('admin.remove_element_after_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.remove_element_after_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'  => 'remove_email_title',
				'type'  => 'custom_html',
				'value' => trans('admin.remove_email_title_value'),
			],
			[
				'name'              => 'remove_email_before',
				'label'             => trans('admin.remove_element_before_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.remove_element_before_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'remove_email_after',
				'label'             => trans('admin.remove_element_after_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.remove_element_after_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'  => 'remove_phone_title',
				'type'  => 'custom_html',
				'value' => trans('admin.remove_phone_title_value'),
			],
			[
				'name'              => 'remove_phone_before',
				'label'             => trans('admin.remove_element_before_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.remove_element_before_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'remove_phone_after',
				'label'             => trans('admin.remove_element_after_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.remove_element_after_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'  => 'phone_number_sep',
				'type'  => 'custom_html',
				'value' => trans('admin.phone_number_sep_value'),
			],
			[
				'name'              => 'convert_phone_number_to_img',
				'label'             => trans('admin.convert_phone_number_to_img_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.convert_phone_number_to_img_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'hide_phone_number',
				'label'             => trans('admin.hide_phone_number_label'),
				'type'              => 'select2_from_array',
				'options'           => [
					0 => trans('admin.hide_phone_number_option_0'),
					1 => trans('admin.hide_phone_number_option_1'),
					2 => trans('admin.hide_phone_number_option_2'),
					3 => trans('admin.hide_phone_number_option_3'),
				],
				'hint'              => trans('admin.hide_phone_number_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			
			[
				'name'  => 'around_phone_number_sep',
				'type'  => 'custom_html',
				'value' => trans('admin.around_phone_number_sep'),
			],
			[
				'name'              => 'show_security_tips',
				'label'             => trans('admin.show_security_tips_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.show_security_tips_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'  => 'around_phone_number_sep_clear_1',
				'type'  => 'custom_html',
				'value' => '<div style="clear: both;"></div>',
			],
			[
				'name'              => 'enable_whatsapp_btn',
				'label'             => trans('admin.enable_whatsapp_btn_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.enable_whatsapp_btn_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'pre_filled_whatsapp_message',
				'label'             => trans('admin.pre_filled_whatsapp_message_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.pre_filled_whatsapp_message_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			
			[
				'name'  => 'dates_sep',
				'type'  => 'custom_html',
				'value' => trans('admin.dates_title'),
			],
			[
				'name'  => 'php_specific_date_format',
				'type'  => 'custom_html',
				'value' => trans('admin.php_specific_date_format_info'),
			],
			[
				'name'              => 'elapsed_time_from_now',
				'label'             => trans('admin.elapsed_time_from_now_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.details_elapsed_time_from_now_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'hide_dates',
				'label'             => trans('admin.hide_dates_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.details_hide_dates_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			
			[
				'name'  => 'others_sep',
				'type'  => 'custom_html',
				'value' => trans('admin.others_sep_value'),
			],
			[
				'name'              => 'pictures_slider',
				'label'             => trans('admin.pictures_slider_label'),
				'type'              => 'select2_from_array',
				'options'           => [
					'horizontal-thumb' => trans('admin.pictures_slider_option_0'),
					'vertical-thumb'   => trans('admin.pictures_slider_option_1'),
				],
				'hint'              => trans('admin.pictures_slider_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'similar_posts',
				'label'             => trans('admin.similar_posts_label'),
				'type'              => 'select2_from_array',
				'options'           => [
					0 => trans('admin.similar_posts_option_0'),
					1 => trans('admin.similar_posts_option_1'),
					2 => trans('admin.similar_posts_option_2'),
				],
				'hint'              => trans('admin.similar_posts_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'similar_posts_limit',
				'label'             => trans('admin.similar_posts_limit_label'),
				'type'              => 'number',
				'attributes'        => [
					'min'  => 1,
					'max'  => 50,
					'step' => 1,
				],
				'hint'              => trans('admin.similar_posts_limit_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'similar_posts_in_carousel',
				'label'             => trans('admin.similar_posts_in_carousel_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.similar_posts_in_carousel_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'guests_can_contact_ads_authors',
				'label'             => trans('admin.guests_can_contact_ads_authors_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.guests_can_contact_ads_authors_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'auth_required_to_report_abuse',
				'label'             => trans('admin.auth_required_to_report_abuse_label'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.auth_required_to_report_abuse_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'  => 'external_services_sep',
				'type'  => 'custom_html',
				'value' => trans('admin.single_html_external_services'),
			],
			[
				'name'              => 'show_post_on_googlemap',
				'label'             => trans('admin.Show Ads on Google Maps'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.show_ads_on_google_maps_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
			[
				'name'              => 'activation_facebook_comments',
				'label'             => trans('admin.Allow Facebook Comments'),
				'type'              => 'checkbox_switch',
				'hint'              => trans('admin.allow_facebook_comments_hint'),
				'wrapperAttributes' => [
					'class' => 'col-md-6',
				],
			],
		]);
		
		return $fields;
	}
}
