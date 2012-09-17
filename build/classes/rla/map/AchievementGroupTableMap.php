<?php



/**
 * This class defines the structure of the 'achievement_group' table.
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
class AchievementGroupTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'rla.map.AchievementGroupTableMap';

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
		$this->setName('achievement_group');
		$this->setPhpName('AchievementGroup');
		$this->setClassname('AchievementGroup');
		$this->setPackage('rla');
		$this->setUseIdGenerator(false);
		$this->setIsCrossRef(true);
		// columns
		$this->addForeignPrimaryKey('ACHIEVEMENT_ID', 'AchievementId', 'INTEGER' , 'achievements', 'ID', true, null, null);
		$this->addForeignPrimaryKey('GROUP_ID', 'GroupId', 'INTEGER' , 'groups', 'ID', true, null, null);
		$this->addColumn('WEIGHT', 'Weight', 'INTEGER', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Achievement', 'Achievement', RelationMap::MANY_TO_ONE, array('achievement_id' => 'id', ), null, null);
		$this->addRelation('Group', 'Group', RelationMap::MANY_TO_ONE, array('group_id' => 'id', ), null, null);
	} // buildRelations()

} // AchievementGroupTableMap
