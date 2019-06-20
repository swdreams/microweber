<?php
namespace Microweber\Utils\Backup;

/**
 * Microweber - Backup Module Database Save
 *
 * @namespace Microweber\Utils\Backup
 * @package DatabaseWriter
 * @author Bozhidar Slaveykov
 */
class DatabaseSave
{

	public static function save($table, $tableData)
	{
		$tableData['skip_cache'] = true;
		$tableData['allow_html'] = true;
		$tableData['allow_scripts'] = true;
		
		$tableData = self::_fixContentEncoding($tableData);

		if ($table == 'content') {
			return self::_saveContent($tableData);
		} else {
			return db_save($table, $tableData);
		}
		
	}
	
	private static function _saveContent($tableData) 
	{
		$tableData['extended_save'] = true;
		
		if (isset($tableData['categories'])) {
			//$mainCategory = explode(',', $tableData['category'])[0];
			$tableData['parent'] = self::_getParentPageId();;
		}
		
		return save_content($tableData);
	}

	private static function _getParentPageId() {
		
		$pages = get_content('content_type=page&subtype=dynamic&limit=1000');
		
		if (empty($pages)) {
				
			$params = array(
				'title' => 'My categories page',
				'content_type' => 'page',
				'subtype' => 'dynamic',
				
				'is_active' => 1,);
			
			//saving
			return save_content($params);
		} else {
			return $pages[0]['id'];
		}
	}
	
	/**
	 * Fix wrong encoding on database
	 *
	 * @param array $item
	 * @return array
	 */
	private static function _fixContentEncoding($content)
	{
		// Fix content encoding
		array_walk_recursive($content, function (&$element) {
			if (is_string($element)) {
				$utf8Chars = explode(' ', 'À Á Â Ã Ä Å Æ Ç È É Ê Ë Ì Í Î Ï Ð Ñ Ò Ó Ô Õ Ö × Ø Ù Ú Û Ü Ý Þ ß à á â ã ä å æ ç è é ê ë ì í î ï ð ñ ò ó ô õ ö');
				foreach ($utf8Chars as $char) {
					$element = str_replace($char, '', $element);
				}
			}
		});
			
		return $content;
	}
}