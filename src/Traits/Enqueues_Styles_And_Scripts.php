<?php

namespace OpenTransposh\Traits;

trait Enqueues_Styles_And_Scripts {
	private function cssSource($path): string {
		return $this->transposh->transposh_plugin_url . TRANSPOSH_DIR_CSS . $path;
	}

	private function jsSource($path): string {
		return $this->transposh->transposh_plugin_url . TRANSPOSH_DIR_JS . $path;
	}
}
