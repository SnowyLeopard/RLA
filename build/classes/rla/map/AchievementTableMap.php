<?php



/**
 * This class defines the structure of the 'achievements' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.rla.map
 */
class AchievementTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'rla.map.AchievementTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('achievements');
		$this->setPhpName('Achievement');
		$this->setClassname('Achievement');
		$this->setPackage('rla');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', true, 255, null);
		$this->addColumn('POINTS', 'Points', 'TINYINT', true, null, null);
		$this->addForeignPrimaryKey('CATEGORY_ID', 'CategoryId', 'INTEGER' , 'categories', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Category', 'Category', RelationMap::MANY_TO_ONE, array('category_id' => 'id', ), null, null);
		$this->addRelation('AchievementUser', 'AchievementUser', RelationMap::ONE_TO_MANY, array('id' => 'achievement_id', ), null, null, 'AchievementUsers');
		$this->addRelation('AchievementGroup', 'AchievementGroup', RelationMap::ONE_TO_MANY, array('id' => 'achievement_id', ), null, null, 'AchievementGroups');
		$this->addRelation('User', 'User', RelationMap::MANY_TO_MANY, array(), null, null, 'Users');
		$this->addRelation('Group', 'Group', RelationMap::MANY_TO_MANY, array(), null, null, 'Groups');
	} // buildRelations()

} // AchievementTableMap
