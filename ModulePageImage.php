<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009-2010
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */


class ModulePageImage extends Module
{
	protected $strTemplate = 'mod_pageimage';
	
	
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### PAGE IMAGE ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'typolight/main.php?do=modules&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}
		
		$this->import('PageImage');

		$strBuffer = parent::generate();
		
		if ($this->Template->src == '')
			return '';
			
		return $strBuffer;
	}
	
	
	protected function compile()
	{
		$arrImage = $this->PageImage->getPageImage($this->levelOffset, $this->inheritPageImage);
		
		if ($arrImage === false)
		{
			return;
		}
		
		$arrSize = deserialize($this->imgSize);
		$arrImage['src'] = $this->getImage($arrImage['src'], $arrSize[0], $arrSize[1], $arrSize[2]);
		
		$this->Template->setData($arrImage);
		
		if (($imgSize = @getimagesize(TL_ROOT . '/' . $arrImage['src'])) !== false)
		{
			$this->Template->size = ' ' . $imgSize[3];
		}
	}
}

