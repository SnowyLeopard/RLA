<?php


/**
 * Base class that represents a query for the 'archievements' table.
 *
 * 
 *
 * @method     ArchievementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ArchievementQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ArchievementQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ArchievementQuery orderByPoints($order = Criteria::ASC) Order by the points column
 * @method     ArchievementQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 * @method     ArchievementQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ArchievementQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 *
 * @method     ArchievementQuery groupById() Group by the id column
 * @method     ArchievementQuery groupByName() Group by the name column
 * @method     ArchievementQuery groupByDescription() Group by the description column
 * @method     ArchievementQuery groupByPoints() Group by the points column
 * @method     ArchievementQuery groupByCategoryId() Group by the category_id column
 * @method     ArchievementQuery groupByGroupId() Group by the group_id column
 * @method     ArchievementQuery groupByWeight() Group by the weight column
 *
 * @method     ArchievementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ArchievementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ArchievementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ArchievementQuery leftJoinCategorie($relationAlias = null) Adds a LEFT JOIN clause to the query using the Categorie relation
 * @method     ArchievementQuery rightJoinCategorie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Categorie relation
 * @method     ArchievementQuery innerJoinCategorie($relationAlias = null) Adds a INNER JOIN clause to the query using the Categorie relation
 *
 * @method     ArchievementQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method     ArchievementQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method     ArchievementQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method     ArchievementQuery leftJoinArchievementUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the ArchievementUser relation
 * @method     ArchievementQuery rightJoinArchievementUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ArchievementUser relation
 * @method     ArchievementQuery innerJoinArchievementUser($relationAlias = null) Adds a INNER JOIN clause to the query using the ArchievementUser relation
 *
 * @method     Archievement findOne(PropelPDO $con = null) Return the first Archievement matching the query
 * @method     Archievement findOneOrCreate(PropelPDO $con = null) Return the first Archievement matching the query, or a new Archievement object populated from the query conditions when no match is found
 *
 * @method     Archievement findOneById(int $id) Return the first Archievement filtered by the id column
 * @method     Archievement findOneByName(string $name) Return the first Archievement filtered by the name column
 * @method     Archievement findOneByDescription(string $description) Return the first Archievement filtered by the description column
 * @method     Archievement findOneByPoints(int $points) Return the first Archievement filtered by the points column
 * @method     Archievement findOneByCategoryId(int $category_id) Return the first Archievement filtered by the category_id column
 * @method     Archievement findOneByGroupId(int $group_id) Return the first Archievement filtered by the group_id column
 * @method     Archievement findOneByWeight(int $weight) Return the first Archievement filtered by the weight column
 *
 * @method     array findById(int $id) Return Archievement objects filtered by the id column
 * @method     array findByName(string $name) Return Archievement objects filtered by the name column
 * @method     array findByDescription(string $description) Return Archievement objects filtered by the description column
 * @method     array findByPoints(int $points) Return Archievement objects filtered by the points column
 * @method     array findByCategoryId(int $category_id) Return Archievement objects filtered by the category_id column
 * @method     array findByGroupId(int $group_id) Return Archievement objects filtered by the group_id column
 * @method     array findByWeight(int $weight) Return Archievement objects filtered by the weight column
 *
 * @package    propel.generator.rla.om
 */
abstract class BaseArchievementQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseArchievementQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'RLA', $modelName = 'Archievement', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ArchievementQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ArchievementQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ArchievementQuery) {
			return $criteria;
		}
		$query = new ArchievementQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj = $c->findPk(array(12, 34, 56), $con);
	 * </code>
	 *
	 * @param     array[$id, $category_id, $group_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Archievement|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ArchievementPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ArchievementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Archievement A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `NAME`, `DESCRIPTION`, `POINTS`, `CATEGORY_ID`, `GROUP_ID`, `WEIGHT` FROM `archievements` WHERE `ID` = :p0 AND `CATEGORY_ID` = :p1 AND `GROUP_ID` = :p2';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
			$stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
			$stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Archievement();
			$obj->hydrate($row);
			ArchievementPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1], (string) $row[2])));
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Archievement|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(ArchievementPeer::ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(ArchievementPeer::CATEGORY_ID, $key[1], Criteria::EQUAL);
		$this->addUsingAlias(ArchievementPeer::GROUP_ID, $key[2], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(ArchievementPeer::ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(ArchievementPeer::CATEGORY_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$cton2 = $this->getNewCriterion(ArchievementPeer::GROUP_ID, $key[2], Criteria::EQUAL);
			$cton0->addAnd($cton2);
			$this->addOr($cton0);
		}

		return $this;
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArchievementPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
	 * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $name The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByName($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArchievementPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the description column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
	 * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $description The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByDescription($description = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($description)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $description)) {
				$description = str_replace('*', '%', $description);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArchievementPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query on the points column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPoints(1234); // WHERE points = 1234
	 * $query->filterByPoints(array(12, 34)); // WHERE points IN (12, 34)
	 * $query->filterByPoints(array('min' => 12)); // WHERE points > 12
	 * </code>
	 *
	 * @param     mixed $points The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByPoints($points = null, $comparison = null)
	{
		if (is_array($points)) {
			$useMinMax = false;
			if (isset($points['min'])) {
				$this->addUsingAlias(ArchievementPeer::POINTS, $points['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($points['max'])) {
				$this->addUsingAlias(ArchievementPeer::POINTS, $points['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArchievementPeer::POINTS, $points, $comparison);
	}

	/**
	 * Filter the query on the category_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCategoryId(1234); // WHERE category_id = 1234
	 * $query->filterByCategoryId(array(12, 34)); // WHERE category_id IN (12, 34)
	 * $query->filterByCategoryId(array('min' => 12)); // WHERE category_id > 12
	 * </code>
	 *
	 * @see       filterByCategorie()
	 *
	 * @param     mixed $categoryId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByCategoryId($categoryId = null, $comparison = null)
	{
		if (is_array($categoryId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArchievementPeer::CATEGORY_ID, $categoryId, $comparison);
	}

	/**
	 * Filter the query on the group_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByGroupId(1234); // WHERE group_id = 1234
	 * $query->filterByGroupId(array(12, 34)); // WHERE group_id IN (12, 34)
	 * $query->filterByGroupId(array('min' => 12)); // WHERE group_id > 12
	 * </code>
	 *
	 * @see       filterByGroup()
	 *
	 * @param     mixed $groupId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByGroupId($groupId = null, $comparison = null)
	{
		if (is_array($groupId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArchievementPeer::GROUP_ID, $groupId, $comparison);
	}

	/**
	 * Filter the query on the weight column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByWeight(1234); // WHERE weight = 1234
	 * $query->filterByWeight(array(12, 34)); // WHERE weight IN (12, 34)
	 * $query->filterByWeight(array('min' => 12)); // WHERE weight > 12
	 * </code>
	 *
	 * @param     mixed $weight The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByWeight($weight = null, $comparison = null)
	{
		if (is_array($weight)) {
			$useMinMax = false;
			if (isset($weight['min'])) {
				$this->addUsingAlias(ArchievementPeer::WEIGHT, $weight['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($weight['max'])) {
				$this->addUsingAlias(ArchievementPeer::WEIGHT, $weight['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ArchievementPeer::WEIGHT, $weight, $comparison);
	}

	/**
	 * Filter the query by a related Categorie object
	 *
	 * @param     Categorie|PropelCollection $categorie The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByCategorie($categorie, $comparison = null)
	{
		if ($categorie instanceof Categorie) {
			return $this
				->addUsingAlias(ArchievementPeer::CATEGORY_ID, $categorie->getId(), $comparison);
		} elseif ($categorie instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ArchievementPeer::CATEGORY_ID, $categorie->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByCategorie() only accepts arguments of type Categorie or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Categorie relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function joinCategorie($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Categorie');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Categorie');
		}

		return $this;
	}

	/**
	 * Use the Categorie relation Categorie object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CategorieQuery A secondary query class using the current class as primary query
	 */
	public function useCategorieQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinCategorie($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Categorie', 'CategorieQuery');
	}

	/**
	 * Filter the query by a related Group object
	 *
	 * @param     Group|PropelCollection $group The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByGroup($group, $comparison = null)
	{
		if ($group instanceof Group) {
			return $this
				->addUsingAlias(ArchievementPeer::GROUP_ID, $group->getId(), $comparison);
		} elseif ($group instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ArchievementPeer::GROUP_ID, $group->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByGroup() only accepts arguments of type Group or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Group relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function joinGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Group');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Group');
		}

		return $this;
	}

	/**
	 * Use the Group relation Group object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GroupQuery A secondary query class using the current class as primary query
	 */
	public function useGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGroup($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Group', 'GroupQuery');
	}

	/**
	 * Filter the query by a related ArchievementUser object
	 *
	 * @param     ArchievementUser $archievementUser  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByArchievementUser($archievementUser, $comparison = null)
	{
		if ($archievementUser instanceof ArchievementUser) {
			return $this
				->addUsingAlias(ArchievementPeer::ID, $archievementUser->getArchievementId(), $comparison);
		} elseif ($archievementUser instanceof PropelCollection) {
			return $this
				->useArchievementUserQuery()
				->filterByPrimaryKeys($archievementUser->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByArchievementUser() only accepts arguments of type ArchievementUser or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ArchievementUser relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function joinArchievementUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ArchievementUser');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ArchievementUser');
		}

		return $this;
	}

	/**
	 * Use the ArchievementUser relation ArchievementUser object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArchievementUserQuery A secondary query class using the current class as primary query
	 */
	public function useArchievementUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinArchievementUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ArchievementUser', 'ArchievementUserQuery');
	}

	/**
	 * Filter the query by a related User object
	 * using the archievement_user table as cross reference
	 *
	 * @param     User $user the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = Criteria::EQUAL)
	{
		return $this
			->useArchievementUserQuery()
			->filterByUser($user, $comparison)
			->endUse();
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Archievement $archievement Object to remove from the list of results
	 *
	 * @return    ArchievementQuery The current query, for fluid interface
	 */
	public function prune($archievement = null)
	{
		if ($archievement) {
			$this->addCond('pruneCond0', $this->getAliasedColName(ArchievementPeer::ID), $archievement->getId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(ArchievementPeer::CATEGORY_ID), $archievement->getCategoryId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond2', $this->getAliasedColName(ArchievementPeer::GROUP_ID), $archievement->getGroupId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseArchievementQuery