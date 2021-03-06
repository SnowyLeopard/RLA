<?php


/**
 * Base class that represents a row from the 'groups' table.
 *
 * 
 *
 * @package    propel.generator.rla.om
 */
abstract class BaseGroup extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'GroupPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        GroupPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the category_id field.
	 * @var        int
	 */
	protected $category_id;

	/**
	 * The value for the group_type field.
	 * @var        int
	 */
	protected $group_type;

	/**
	 * @var        Category
	 */
	protected $aCategory;

	/**
	 * @var        array AchievementGroup[] Collection to store aggregation of AchievementGroup objects.
	 */
	protected $collAchievementGroups;

	/**
	 * @var        array Achievement[] Collection to store aggregation of Achievement objects.
	 */
	protected $collAchievements;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $achievementsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $achievementGroupsScheduledForDeletion = null;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get the [category_id] column value.
	 * 
	 * @return     int
	 */
	public function getCategoryId()
	{
		return $this->category_id;
	}

	/**
	 * Get the [group_type] column value.
	 * 
	 * @return     int
	 */
	public function getGroupType()
	{
		if (null === $this->group_type) {
			return null;
		}
		$valueSet = GroupPeer::getValueSet(GroupPeer::GROUP_TYPE);
		if (!isset($valueSet[$this->group_type])) {
			throw new PropelException('Unknown stored enum key: ' . $this->group_type);
		}
		return $valueSet[$this->group_type];
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Group The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = GroupPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Group The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = GroupPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     Group The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = GroupPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [category_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Group The current object (for fluent API support)
	 */
	public function setCategoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->category_id !== $v) {
			$this->category_id = $v;
			$this->modifiedColumns[] = GroupPeer::CATEGORY_ID;
		}

		if ($this->aCategory !== null && $this->aCategory->getId() !== $v) {
			$this->aCategory = null;
		}

		return $this;
	} // setCategoryId()

	/**
	 * Set the value of [group_type] column.
	 * 
	 * @param      int $v new value
	 * @return     Group The current object (for fluent API support)
	 */
	public function setGroupType($v)
	{
		if ($v !== null) {
			$valueSet = GroupPeer::getValueSet(GroupPeer::GROUP_TYPE);
			if (!in_array($v, $valueSet)) {
				throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
			}
			$v = array_search($v, $valueSet);
		}

		if ($this->group_type !== $v) {
			$this->group_type = $v;
			$this->modifiedColumns[] = GroupPeer::GROUP_TYPE;
		}

		return $this;
	} // setGroupType()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->category_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->group_type = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 5; // 5 = GroupPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Group object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aCategory !== null && $this->category_id !== $this->aCategory->getId()) {
			$this->aCategory = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = GroupPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCategory = null;
			$this->collAchievementGroups = null;

			$this->collAchievements = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = GroupQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				GroupPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aCategory !== null) {
				if ($this->aCategory->isModified() || $this->aCategory->isNew()) {
					$affectedRows += $this->aCategory->save($con);
				}
				$this->setCategory($this->aCategory);
			}

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				$this->resetModified();
			}

			if ($this->achievementsScheduledForDeletion !== null) {
				if (!$this->achievementsScheduledForDeletion->isEmpty()) {
					AchievementGroupQuery::create()
						->filterByPrimaryKeys($this->achievementsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->achievementsScheduledForDeletion = null;
				}

				foreach ($this->getAchievements() as $achievement) {
					if ($achievement->isModified()) {
						$achievement->save($con);
					}
				}
			}

			if ($this->achievementGroupsScheduledForDeletion !== null) {
				if (!$this->achievementGroupsScheduledForDeletion->isEmpty()) {
					AchievementGroupQuery::create()
						->filterByPrimaryKeys($this->achievementGroupsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->achievementGroupsScheduledForDeletion = null;
				}
			}

			if ($this->collAchievementGroups !== null) {
				foreach ($this->collAchievementGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Insert the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;

		$this->modifiedColumns[] = GroupPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . GroupPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(GroupPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(GroupPeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}
		if ($this->isColumnModified(GroupPeer::DESCRIPTION)) {
			$modifiedColumns[':p' . $index++]  = '`DESCRIPTION`';
		}
		if ($this->isColumnModified(GroupPeer::CATEGORY_ID)) {
			$modifiedColumns[':p' . $index++]  = '`CATEGORY_ID`';
		}
		if ($this->isColumnModified(GroupPeer::GROUP_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`GROUP_TYPE`';
		}

		$sql = sprintf(
			'INSERT INTO `groups` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
						break;
					case '`NAME`':
						$stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
						break;
					case '`DESCRIPTION`':
						$stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
						break;
					case '`CATEGORY_ID`':
						$stmt->bindValue($identifier, $this->category_id, PDO::PARAM_INT);
						break;
					case '`GROUP_TYPE`':
						$stmt->bindValue($identifier, $this->group_type, PDO::PARAM_INT);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		try {
			$pk = $con->lastInsertId();
		} catch (Exception $e) {
			throw new PropelException('Unable to get autoincrement id.', $e);
		}
		$this->setId($pk);

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aCategory !== null) {
				if (!$this->aCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCategory->getValidationFailures());
				}
			}


			if (($retval = GroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAchievementGroups !== null) {
					foreach ($this->collAchievementGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getCategoryId();
				break;
			case 4:
				return $this->getGroupType();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['Group'][serialize($this->getPrimaryKey())])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Group'][serialize($this->getPrimaryKey())] = true;
		$keys = GroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getCategoryId(),
			$keys[4] => $this->getGroupType(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aCategory) {
				$result['Category'] = $this->aCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collAchievementGroups) {
				$result['AchievementGroups'] = $this->collAchievementGroups->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setCategoryId($value);
				break;
			case 4:
				$valueSet = GroupPeer::getValueSet(GroupPeer::GROUP_TYPE);
				if (isset($valueSet[$value])) {
					$value = $valueSet[$value];
				}
				$this->setGroupType($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCategoryId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setGroupType($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(GroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(GroupPeer::ID)) $criteria->add(GroupPeer::ID, $this->id);
		if ($this->isColumnModified(GroupPeer::NAME)) $criteria->add(GroupPeer::NAME, $this->name);
		if ($this->isColumnModified(GroupPeer::DESCRIPTION)) $criteria->add(GroupPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(GroupPeer::CATEGORY_ID)) $criteria->add(GroupPeer::CATEGORY_ID, $this->category_id);
		if ($this->isColumnModified(GroupPeer::GROUP_TYPE)) $criteria->add(GroupPeer::GROUP_TYPE, $this->group_type);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GroupPeer::DATABASE_NAME);
		$criteria->add(GroupPeer::ID, $this->id);
		$criteria->add(GroupPeer::CATEGORY_ID, $this->category_id);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();
		$pks[0] = $this->getId();
		$pks[1] = $this->getCategoryId();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{
		$this->setId($keys[0]);
		$this->setCategoryId($keys[1]);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return (null === $this->getId()) && (null === $this->getCategoryId());
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Group (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setName($this->getName());
		$copyObj->setDescription($this->getDescription());
		$copyObj->setCategoryId($this->getCategoryId());
		$copyObj->setGroupType($this->getGroupType());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getAchievementGroups() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAchievementGroup($relObj->copy($deepCopy));
				}
			}

			//unflag object copy
			$this->startCopy = false;
		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Group Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     GroupPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new GroupPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Category object.
	 *
	 * @param      Category $v
	 * @return     Group The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCategory(Category $v = null)
	{
		if ($v === null) {
			$this->setCategoryId(NULL);
		} else {
			$this->setCategoryId($v->getId());
		}

		$this->aCategory = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Category object, it will not be re-added.
		if ($v !== null) {
			$v->addGroup($this);
		}

		return $this;
	}


	/**
	 * Get the associated Category object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Category The associated Category object.
	 * @throws     PropelException
	 */
	public function getCategory(PropelPDO $con = null)
	{
		if ($this->aCategory === null && ($this->category_id !== null)) {
			$this->aCategory = CategoryQuery::create()->findPk($this->category_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aCategory->addGroups($this);
			 */
		}
		return $this->aCategory;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
		if ('AchievementGroup' == $relationName) {
			return $this->initAchievementGroups();
		}
	}

	/**
	 * Clears out the collAchievementGroups collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAchievementGroups()
	 */
	public function clearAchievementGroups()
	{
		$this->collAchievementGroups = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAchievementGroups collection.
	 *
	 * By default this just sets the collAchievementGroups collection to an empty array (like clearcollAchievementGroups());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initAchievementGroups($overrideExisting = true)
	{
		if (null !== $this->collAchievementGroups && !$overrideExisting) {
			return;
		}
		$this->collAchievementGroups = new PropelObjectCollection();
		$this->collAchievementGroups->setModel('AchievementGroup');
	}

	/**
	 * Gets an array of AchievementGroup objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Group is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array AchievementGroup[] List of AchievementGroup objects
	 * @throws     PropelException
	 */
	public function getAchievementGroups($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collAchievementGroups || null !== $criteria) {
			if ($this->isNew() && null === $this->collAchievementGroups) {
				// return empty collection
				$this->initAchievementGroups();
			} else {
				$collAchievementGroups = AchievementGroupQuery::create(null, $criteria)
					->filterByGroup($this)
					->find($con);
				if (null !== $criteria) {
					return $collAchievementGroups;
				}
				$this->collAchievementGroups = $collAchievementGroups;
			}
		}
		return $this->collAchievementGroups;
	}

	/**
	 * Sets a collection of AchievementGroup objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $achievementGroups A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setAchievementGroups(PropelCollection $achievementGroups, PropelPDO $con = null)
	{
		$this->achievementGroupsScheduledForDeletion = $this->getAchievementGroups(new Criteria(), $con)->diff($achievementGroups);

		foreach ($achievementGroups as $achievementGroup) {
			// Fix issue with collection modified by reference
			if ($achievementGroup->isNew()) {
				$achievementGroup->setGroup($this);
			}
			$this->addAchievementGroup($achievementGroup);
		}

		$this->collAchievementGroups = $achievementGroups;
	}

	/**
	 * Returns the number of related AchievementGroup objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related AchievementGroup objects.
	 * @throws     PropelException
	 */
	public function countAchievementGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collAchievementGroups || null !== $criteria) {
			if ($this->isNew() && null === $this->collAchievementGroups) {
				return 0;
			} else {
				$query = AchievementGroupQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByGroup($this)
					->count($con);
			}
		} else {
			return count($this->collAchievementGroups);
		}
	}

	/**
	 * Method called to associate a AchievementGroup object to this object
	 * through the AchievementGroup foreign key attribute.
	 *
	 * @param      AchievementGroup $l AchievementGroup
	 * @return     Group The current object (for fluent API support)
	 */
	public function addAchievementGroup(AchievementGroup $l)
	{
		if ($this->collAchievementGroups === null) {
			$this->initAchievementGroups();
		}
		if (!$this->collAchievementGroups->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddAchievementGroup($l);
		}

		return $this;
	}

	/**
	 * @param	AchievementGroup $achievementGroup The achievementGroup object to add.
	 */
	protected function doAddAchievementGroup($achievementGroup)
	{
		$this->collAchievementGroups[]= $achievementGroup;
		$achievementGroup->setGroup($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Group is new, it will return
	 * an empty collection; or if this Group has previously
	 * been saved, it will retrieve related AchievementGroups from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Group.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array AchievementGroup[] List of AchievementGroup objects
	 */
	public function getAchievementGroupsJoinAchievement($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = AchievementGroupQuery::create(null, $criteria);
		$query->joinWith('Achievement', $join_behavior);

		return $this->getAchievementGroups($query, $con);
	}

	/**
	 * Clears out the collAchievements collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAchievements()
	 */
	public function clearAchievements()
	{
		$this->collAchievements = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAchievements collection.
	 *
	 * By default this just sets the collAchievements collection to an empty collection (like clearAchievements());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initAchievements()
	{
		$this->collAchievements = new PropelObjectCollection();
		$this->collAchievements->setModel('Achievement');
	}

	/**
	 * Gets a collection of Achievement objects related by a many-to-many relationship
	 * to the current object by way of the achievement_group cross-reference table.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Group is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     PropelCollection|array Achievement[] List of Achievement objects
	 */
	public function getAchievements($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collAchievements || null !== $criteria) {
			if ($this->isNew() && null === $this->collAchievements) {
				// return empty collection
				$this->initAchievements();
			} else {
				$collAchievements = AchievementQuery::create(null, $criteria)
					->filterByGroup($this)
					->find($con);
				if (null !== $criteria) {
					return $collAchievements;
				}
				$this->collAchievements = $collAchievements;
			}
		}
		return $this->collAchievements;
	}

	/**
	 * Sets a collection of Achievement objects related by a many-to-many relationship
	 * to the current object by way of the achievement_group cross-reference table.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $achievements A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setAchievements(PropelCollection $achievements, PropelPDO $con = null)
	{
		$achievementGroups = AchievementGroupQuery::create()
			->filterByAchievement($achievements)
			->filterByGroup($this)
			->find($con);

		$this->achievementsScheduledForDeletion = $this->getAchievementGroups()->diff($achievementGroups);
		$this->collAchievementGroups = $achievementGroups;

		foreach ($achievements as $achievement) {
			// Fix issue with collection modified by reference
			if ($achievement->isNew()) {
				$this->doAddAchievement($achievement);
			} else {
				$this->addAchievement($achievement);
			}
		}

		$this->collAchievements = $achievements;
	}

	/**
	 * Gets the number of Achievement objects related by a many-to-many relationship
	 * to the current object by way of the achievement_group cross-reference table.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      boolean $distinct Set to true to force count distinct
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     int the number of related Achievement objects
	 */
	public function countAchievements($criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collAchievements || null !== $criteria) {
			if ($this->isNew() && null === $this->collAchievements) {
				return 0;
			} else {
				$query = AchievementQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByGroup($this)
					->count($con);
			}
		} else {
			return count($this->collAchievements);
		}
	}

	/**
	 * Associate a Achievement object to this object
	 * through the achievement_group cross reference table.
	 *
	 * @param      Achievement $achievement The AchievementGroup object to relate
	 * @return     void
	 */
	public function addAchievement(Achievement $achievement)
	{
		if ($this->collAchievements === null) {
			$this->initAchievements();
		}
		if (!$this->collAchievements->contains($achievement)) { // only add it if the **same** object is not already associated
			$this->doAddAchievement($achievement);

			$this->collAchievements[]= $achievement;
		}
	}

	/**
	 * @param	Achievement $achievement The achievement object to add.
	 */
	protected function doAddAchievement($achievement)
	{
		$achievementGroup = new AchievementGroup();
		$achievementGroup->setAchievement($achievement);
		$this->addAchievementGroup($achievementGroup);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->name = null;
		$this->description = null;
		$this->category_id = null;
		$this->group_type = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collAchievementGroups) {
				foreach ($this->collAchievementGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAchievements) {
				foreach ($this->collAchievements as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collAchievementGroups instanceof PropelCollection) {
			$this->collAchievementGroups->clearIterator();
		}
		$this->collAchievementGroups = null;
		if ($this->collAchievements instanceof PropelCollection) {
			$this->collAchievements->clearIterator();
		}
		$this->collAchievements = null;
		$this->aCategory = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(GroupPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseGroup
