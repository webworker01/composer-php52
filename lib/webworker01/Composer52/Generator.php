<?php
/*
 * Copyright (c) 2012, Christoph Mewes, http://www.webworker01.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

namespace webworker01\Composer52;

use Composer\Repository\CompositeRepository;
use Composer\Script\Event;

class Generator {
	public static function onPostInstallCmd(Event $event) {
		$composer            = $event->getComposer();
		$installationManager = $composer->getInstallationManager();
		$localRepos          = new CompositeRepository($composer->getRepositoryManager()->getLocalRepositories());
		$package             = $composer->getPackage();
		$config              = $composer->getConfig();

		// We can't gain access to the Command's input object, so we have to look
		// for -o / --optimize-autoloader ourselves. Sadly, neither getopt() works
		// (always returns an empty array), nor does Symfony's Console Input, as
		// it expects a full definition of the current command line and we can't
		// provide that.

//		$def   = new InputDefinition(array(new InputOption('optimize', 'o', InputOption::VALUE_NONE)));
//		$input = new ArgvInput(null, $def);
//		var_dump($input->hasOption('o')); // "Too many arguments"

//		$options  = getopt('o', array('optimize-autoloader')); // always array()
//		$optimize = !empty($options);

		$args     = $_SERVER['argv'];
		$optimize = in_array('-o', $args) || in_array('-o', $args);

		$generator = new AutoloadGenerator();
		$generator->dump($config, $localRepos, $package, $installationManager, 'composer', $optimize);
	}
}
