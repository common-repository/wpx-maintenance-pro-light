<?php

namespace WPXMaintenanceProLight\WPBones\Html;

class Html
{

  protected static $htmlTags = [
    'a'        => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagA',
    'button'   => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagButton',
    'checkbox' => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagCheckbox',
    'datetime' => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagDatetime',
    'fieldset' => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagFieldSet',
    'form'     => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagForm',
    'input'    => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagInput',
    'label'    => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagLabel',
    'optgroup' => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagOptGroup',
    'option'   => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagOption',
    'select'   => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagSelect',
    'textarea' => '\WPXMaintenanceProLight\WPBones\Html\HtmlTagTextArea',
  ];

  public static function __callStatic( $name, $arguments )
  {
    if ( in_array( $name, array_keys( self::$htmlTags ) ) ) {
      $args = ( isset( $arguments[ 0 ] ) && ! is_null( $arguments[ 0 ] ) ) ? $arguments[ 0 ] : [];

      return new self::$htmlTags[ $name ]( $args );
    }
  }
}