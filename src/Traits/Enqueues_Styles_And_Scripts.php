<?php

namespace OpenTransposh\Traits;

trait Enqueues_Styles_And_Scripts {
	private function enqueueHeadScript(
		string $handle,
		string $path,
		array $dependencies = [],
		string $version = TRANSPOSH_PLUGIN_VER
	): void {
		wp_enqueue_script( $handle, $this->jsSource($path), $dependencies, $version );
	}

	private function enqueueFooterScript(
		string $handle,
		string $path,
		array $dependencies = [],
		string $version = TRANSPOSH_PLUGIN_VER
	): void {
		wp_enqueue_script( $handle, $this->jsSource($path), $dependencies, $version, true );
	}

	private function cssSource($path): string {
		return $this->transposh->transposh_plugin_url . TRANSPOSH_DIR_CSS . $path;
	}

	private function jquerySource($path): string {
		return $this->transposh->transposh_plugin_url . 'jquery-ui' . $path;
	}

	private function jsSource($path): string {
		return $this->transposh->transposh_plugin_url . TRANSPOSH_DIR_JS . $path;
	}
}
