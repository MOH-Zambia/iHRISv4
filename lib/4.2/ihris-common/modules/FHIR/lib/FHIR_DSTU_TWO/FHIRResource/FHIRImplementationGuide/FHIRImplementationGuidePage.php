<?php namespace FHIR_DSTU_TWO\FHIRResource\FHIRImplementationGuide;

/*!
 * This class was generated with the PHPFHIR library (https://github.com/dcarbone/php-fhir) using
 * class definitions from HL7 FHIR (https://www.hl7.org/fhir/)
 * 
 * Class creation date: May 13th, 2016
 * 
 * PHPFHIR Copyright:
 * 
 * Copyright 2016 Daniel Carbone (daniel.p.carbone@gmail.com)
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *        http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 *
 * FHIR Copyright Notice:
 *
 *   Copyright (c) 2011+, HL7, Inc.
 *   All rights reserved.
 * 
 *   Redistribution and use in source and binary forms, with or without modification,
 *   are permitted provided that the following conditions are met:
 * 
 *    * Redistributions of source code must retain the above copyright notice, this
 *      list of conditions and the following disclaimer.
 *    * Redistributions in binary form must reproduce the above copyright notice,
 *      this list of conditions and the following disclaimer in the documentation
 *      and/or other materials provided with the distribution.
 *    * Neither the name of HL7 nor the names of its contributors may be used to
 *      endorse or promote products derived from this software without specific
 *      prior written permission.
 * 
 *   THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 *   ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 *   WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 *   IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,
 *   INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 *   NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 *   PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 *   WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 *   ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 *   POSSIBILITY OF SUCH DAMAGE.
 * 
 * 
 *   Generated on Sat, Oct 24, 2015 07:41+1100 for FHIR v1.0.2
 * 
 *   Note: the schemas & schematrons do not contain all of the rules about what makes resources
 *   valid. Implementers will still need to be familiar with the content of the specification and with
 *   any profiles that apply to the resources in order to make a conformant implementation.
 * 
 */

use FHIR_DSTU_TWO\FHIRElement\FHIRBackboneElement;
use FHIR_DSTU_TWO\JsonSerializable;

/**
 * A set of rules or how FHIR is used to solve a particular problem. This resource is used to gather all the parts of an implementation guide into a logical whole, and to publish a computable definition of all the parts.
 */
class FHIRImplementationGuidePage extends FHIRBackboneElement implements JsonSerializable
{
    /**
     * The source address for the page.
     * @var \FHIR_DSTU_TWO\FHIRElement\FHIRUri
     */
    public $source = null;

    /**
     * A short name used to represent this page in navigational structures such as table of contents, bread crumbs, etc.
     * @var \FHIR_DSTU_TWO\FHIRElement\FHIRString
     */
    public $name = null;

    /**
     * The kind of page that this is. Some pages are autogenerated (list, example), and other kinds are of interest so that tools can navigate the user to the page of interest.
     * @var \FHIR_DSTU_TWO\FHIRElement\FHIRGuidePageKind
     */
    public $kind = null;

    /**
     * For constructed pages, what kind of resources to include in the list.
     * @var \FHIR_DSTU_TWO\FHIRElement\FHIRCode[]
     */
    public $type = array();

    /**
     * For constructed pages, a list of packages to include in the page (or else empty for everything).
     * @var \FHIR_DSTU_TWO\FHIRElement\FHIRString[]
     */
    public $package = array();

    /**
     * The format of the page.
     * @var \FHIR_DSTU_TWO\FHIRElement\FHIRCode
     */
    public $format = null;

    /**
     * Nested Pages/Sections under this page.
     * @var \FHIR_DSTU_TWO\FHIRResource\FHIRImplementationGuide\FHIRImplementationGuidePage[]
     */
    public $page = array();

    /**
     * @var string
     */
    private $_fhirElementName = 'ImplementationGuide.Page';

    /**
     * The source address for the page.
     * @return \FHIR_DSTU_TWO\FHIRElement\FHIRUri
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * The source address for the page.
     * @param \FHIR_DSTU_TWO\FHIRElement\FHIRUri $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * A short name used to represent this page in navigational structures such as table of contents, bread crumbs, etc.
     * @return \FHIR_DSTU_TWO\FHIRElement\FHIRString
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * A short name used to represent this page in navigational structures such as table of contents, bread crumbs, etc.
     * @param \FHIR_DSTU_TWO\FHIRElement\FHIRString $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * The kind of page that this is. Some pages are autogenerated (list, example), and other kinds are of interest so that tools can navigate the user to the page of interest.
     * @return \FHIR_DSTU_TWO\FHIRElement\FHIRGuidePageKind
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * The kind of page that this is. Some pages are autogenerated (list, example), and other kinds are of interest so that tools can navigate the user to the page of interest.
     * @param \FHIR_DSTU_TWO\FHIRElement\FHIRGuidePageKind $kind
     * @return $this
     */
    public function setKind($kind)
    {
        $this->kind = $kind;
        return $this;
    }

    /**
     * For constructed pages, what kind of resources to include in the list.
     * @return \FHIR_DSTU_TWO\FHIRElement\FHIRCode[]
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * For constructed pages, what kind of resources to include in the list.
     * @param \FHIR_DSTU_TWO\FHIRElement\FHIRCode[] $type
     * @return $this
     */
    public function addType($type)
    {
        $this->type[] = $type;
        return $this;
    }

    /**
     * For constructed pages, a list of packages to include in the page (or else empty for everything).
     * @return \FHIR_DSTU_TWO\FHIRElement\FHIRString[]
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * For constructed pages, a list of packages to include in the page (or else empty for everything).
     * @param \FHIR_DSTU_TWO\FHIRElement\FHIRString[] $package
     * @return $this
     */
    public function addPackage($package)
    {
        $this->package[] = $package;
        return $this;
    }

    /**
     * The format of the page.
     * @return \FHIR_DSTU_TWO\FHIRElement\FHIRCode
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * The format of the page.
     * @param \FHIR_DSTU_TWO\FHIRElement\FHIRCode $format
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Nested Pages/Sections under this page.
     * @return \FHIR_DSTU_TWO\FHIRResource\FHIRImplementationGuide\FHIRImplementationGuidePage[]
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Nested Pages/Sections under this page.
     * @param \FHIR_DSTU_TWO\FHIRResource\FHIRImplementationGuide\FHIRImplementationGuidePage[] $page
     * @return $this
     */
    public function addPage($page)
    {
        $this->page[] = $page;
        return $this;
    }

    /**
     * @return string
     */
    public function get_fhirElementName()
    {
        return $this->_fhirElementName;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->get_fhirElementName();
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $json = parent::jsonSerialize();
        if (null !== $this->source) $json['source'] = $this->source->jsonSerialize();
        if (null !== $this->name) $json['name'] = $this->name->jsonSerialize();
        if (null !== $this->kind) $json['kind'] = $this->kind->jsonSerialize();
        if (0 < count($this->type)) {
            $json['type'] = array();
            foreach($this->type as $type) {
                $json['type'][] = $type->jsonSerialize();
            }
        }
        if (0 < count($this->package)) {
            $json['package'] = array();
            foreach($this->package as $package) {
                $json['package'][] = $package->jsonSerialize();
            }
        }
        if (null !== $this->format) $json['format'] = $this->format->jsonSerialize();
        if (0 < count($this->page)) {
            $json['page'] = array();
            foreach($this->page as $page) {
                $json['page'][] = $page->jsonSerialize();
            }
        }
        return $json;
    }

    /**
     * @param boolean $returnSXE
     * @param \SimpleXMLElement $sxe
     * @return string|\SimpleXMLElement
     */
    public function xmlSerialize($returnSXE = false, $sxe = null)
    {
        if (null === $sxe) $sxe = new \SimpleXMLElement('<ImplementationGuidePage xmlns="http://hl7.org/fhir"></ImplementationGuidePage>');
        parent::xmlSerialize(true, $sxe);
        if (null !== $this->source) $this->source->xmlSerialize(true, $sxe->addChild('source'));
        if (null !== $this->name) $this->name->xmlSerialize(true, $sxe->addChild('name'));
        if (null !== $this->kind) $this->kind->xmlSerialize(true, $sxe->addChild('kind'));
        if (0 < count($this->type)) {
            foreach($this->type as $type) {
                $type->xmlSerialize(true, $sxe->addChild('type'));
            }
        }
        if (0 < count($this->package)) {
            foreach($this->package as $package) {
                $package->xmlSerialize(true, $sxe->addChild('package'));
            }
        }
        if (null !== $this->format) $this->format->xmlSerialize(true, $sxe->addChild('format'));
        if (0 < count($this->page)) {
            foreach($this->page as $page) {
                $page->xmlSerialize(true, $sxe->addChild('page'));
            }
        }
        if ($returnSXE) return $sxe;
        return $sxe->saveXML();
    }


}