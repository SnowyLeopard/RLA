<?php



/**
 * This class defines the structure of the 'archievement_user' table.
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
class ArchievementUserTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'rla.map.ArchievementUserTableMap';

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
		$this->setName('archievement_user');
		$this->setPhpName('ArchievementUser');
		$this->setClassname('ArchievementUser');
		$this->setPackage('rla');
		$this->setUseIdGenerator(false);
		$this->setIsCrossRef(true);
		// columns
		$this->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'users', 'ID', true, null, null);
		$this->addForeignPrimaryKey('ARCHIEVEMENT_ID', 'ArchievementId', 'INTEGER' , 'archievements', 'ID', true, null, null);
		$this->addColumn('CONFIRMED', 'Confirmed', 'BOOLEAN', true, 1, null);
		$this->addColumn('DATE', 'Date', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
		$this->addRelation('Archievement', 'Archievement', RelationMap::MANY_TO_ONE, array('archievement_id' => 'id', ), null, null);
	} // buildRelations()

} // ArchievementUserTableMap
