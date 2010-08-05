<?php
/**
 * PHP_CodeCoverage
 *
 * Copyright (c) 2009-2010, Sebastian Bergmann <sb@sebastian-bergmann.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   PHP
 * @package    CodeCoverage
 * @author     Sebastian Marek <proofek@gmail.com>
 * @copyright  2009-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       http://github.com/sebastianbergmann/php-code-coverage
 * @since      File available since Release 1.0.0
 */

require_once 'PHP/CodeCoverage.php';
require_once 'PHP/Token/Stream/CachingFactory.php';

/**
 * Generates a Clover XML logfile from an PHP_CodeCoverage object.
 *
 * @category   PHP
 * @package    CodeCoverage
 * @author     Sebastian Marek <proofek@gmail.com>
 * @copyright  2009-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://github.com/sebastianbergmann/php-code-coverage
 * @since      Class available since Release 1.0.0
 */
class PHP_CodeCoverage_Report_Cobertura
{
    /**
     * @param  PHP_CodeCoverage $coverage
     * @param  string           $target
     * @param  string           $name
     * @return string
     */
    public function process(PHP_CodeCoverage $coverage, $target = NULL, $name = NULL)
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $document->formatOutput = TRUE;

        $root = $document->createElement('coverage');
        $root->setAttribute('line-rate', '0.0');
        $root->setAttribute('branch-rate', '0.0');
        $root->setAttribute('lines-covered', '0.0');
        $root->setAttribute('lines-valid', '0.0');
        $root->setAttribute('branches-covered', '0.0');
        $root->setAttribute('branches-valid', '0.0');
        $root->setAttribute('complexity', '0.0');
        $root->setAttribute('version', '1.9.4.1');
        $root->setAttribute('timestamp', $_SERVER['REQUEST_TIME']);
        $document->appendChild($root);

        $packagesRoot = $document->createElement('packages');
        $root->appendChild($packagesRoot);

        if ($target !== NULL) {
            return $document->save($target);
        } else {
            return $document->saveXML();
        }
    }
}
