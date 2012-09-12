<?php



/**
 * This class defines the structure of the 'users' table.
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
class UserTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'rla.map.UserTableMap';

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
		$this->setName('users');
		$this->setPhpName('User');
		$this->setClassname('User');
		$this->setPackage('rla');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('USERNAME', 'Username', 'VARCHAR', true, 30, null);
		$this->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 60, null);
		$this->addColumn('HASH', 'Hash', 'VARCHAR', true, 60, null);
		$this->addColumn('LEVEL', 'Level', 'ENUM', true, null, null);
		$this->getColumn('LEVEL', false)->setValueSet(array (
  0 => 'admin',
  1 => 'mod',
  2 => 'user',
));
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('ArchievementUser', 'ArchievementUser', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'ArchievementUsers');
		$this->addRelation('Archievement', 'Archievement', RelationMap::MANY_TO_MANY, array(), null, null, 'Archievements');
	} // buildRelations()

} // UserTableMap