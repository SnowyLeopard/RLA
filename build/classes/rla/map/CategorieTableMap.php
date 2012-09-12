<?php



/**
 * This class defines the structure of the 'categories' table.
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
class CategorieTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'rla.map.CategorieTableMap';

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
		$this->setName('categories');
		$this->setPhpName('Categorie');
		$this->setClassname('Categorie');
		$this->setPackage('rla');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', true, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Archievement', 'Archievement', RelationMap::ONE_TO_MANY, array('id' => 'category_id', ), null, null, 'Archievements');
		$this->addRelation('Group', 'Group', RelationMap::ONE_TO_MANY, array('id' => 'category_id', ), null, null, 'Groups');
	} // buildRelations()

} // CategorieTableMap
