<?php

declare(strict_types=1);

/*
 * This file is part of eelly package.
 *
 * (c) eelly.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eelly\DocsBundle\Adapter;

use Eelly\Exception\RequestException;
use ReflectionClass;

/**
 * Class ServiceDocumentShow.
 */
class ServiceDocumentShow extends AbstractDocumentShow implements DocumentShowInterface
{
    /**
     * @var string
     */
    private $class;

    public function __construct(string $module, string $class)
    {
        $class = sprintf('Eelly\SDK\%s\Service\%sInterface', ucfirst($module), ucfirst($class));
        $this->class = $class;
    }

    public function renderBody(): void
    {
        if (!interface_exists($this->class)) {
            throw new RequestException(404, null, $this->request, $this->response);
        }
        $interface = new ReflectionClass($this->class);
        $interfaceName = $interface->getName();
        $docComment = $this->getDocComment($interface->getDocComment());
        $methodList = '';
        foreach ($interface->getMethods() as $method) {
            $docc = $this->getDocComment($method->getDocComment());
            $methodList .= sprintf("- [%s](%s) %s\n", $method->getName(), $_SERVER['REQUEST_URI'].'/'.$method->getName(), $docc['summary']);
        }
        $markdown = <<<EOF
# {$docComment['summary']}
> {$interfaceName}
{$docComment['description']}
### 接口列表
$methodList
EOF;
        $this->view->markup = $this->parserMarkdown($markdown);
        $this->view->render('apidoc', 'service');
    }
}
