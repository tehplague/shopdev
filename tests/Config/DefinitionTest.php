<?php

namespace Jtl\Shop4\Tests\Config;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;

use Jtl\Shop4\Config\Definition\SystemConfiguration;
use Jtl\Shop4\Tests\Common\TestCase;

/**
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
class DefinitionTest extends TestCase
{
    public function testConfigDefinition()
    {
        $yaml = file_get_contents(APP_ROOT . '/config/config.yml');
        $parsedYaml = Yaml::parse($yaml);

        $this->assertNotNull($parsedYaml);
        $this->assertTrue(is_array($parsedYaml));

        $processor = new Processor();
        $definition = new SystemConfiguration();

        $config = $processor->processConfiguration(
            $definition,
            array($parsedYaml)
        );

        $this->assertNotNull($config);
        $this->assertTrue(is_array($config));
    }
}
