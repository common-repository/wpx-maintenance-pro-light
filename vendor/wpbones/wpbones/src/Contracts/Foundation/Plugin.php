<?php

namespace WPXMaintenanceProLight\WPBones\Contracts\Foundation;

use WPXMaintenanceProLight\WPBones\Contracts\Container\Container;

interface Plugin extends Container {

  /**
   * Get the base path of the Plugin installation.
   *
   * @return string
   */
  public function getBasePath();
}