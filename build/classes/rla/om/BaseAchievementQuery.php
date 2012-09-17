<?php


/**
 * Base class that represents a query for the 'achievements' table.
 *
 * 
 *
 * @method     AchievementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     AchievementQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     AchievementQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     AchievementQuery orderByPoints($order = Criteria::ASC) Order by the points column
 * @method     AchievementQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 *
 * @method     AchievementQuery groupById() Group by the id column
 * @method     AchievementQuery groupByName() Group by the name column
 * @method     AchievementQuery groupByDescription() Group by the description column
 * @method     AchievementQuery groupByPoints() Group by the points column
 * @method     AchievementQuery groupByCategoryId() Group by the category_id column
 *
 * @method     AchievementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AchievementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AchievementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     AchievementQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     AchievementQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     AchievementQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     AchievementQuery leftJoinAchievementUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the AchievementUser relation
 * @method     AchievementQuery rightJoinAchievementUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AchievementUser relation
 * @method     AchievementQuery innerJoinAchievementUser($relationAlias = null) Adds a INNER JOIN clause to the query using the AchievementUser relation
 *
 * @method     AchievementQuery leftJoinAchievementGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the AchievementGroup relation
 * @method     AchievementQuery rightJoinAchievementGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AchievementGroup relation
 * @method     AchievementQuery innerJoinAchievementGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the AchievementGroup relation
 *
 * @method     Achievement findOne(PropelPDO $con = null) Return the first Achievement matching the query
 * @method     Achievement findOneOrCreate(PropelPDO $con = null) Return the first Achievement matching the query, or a new Achievement object populated from the query conditions when no match is found
 *
 * @method     Achievement findOneById(int $id) Return the first Achievement filtered by the id column
 * @method     Achievement findOneByName(string $name) Return the first Achievement filtered by the name column
 * @method     Achievement findOneByDescription(string $description) Return the first Achievement filtered by the description column
 * @method     Achievement findOneByPoints(int $points) Return the first Achievement filtered by the points column
 * @method     Achievement findOneByCategoryId(int $category_id) Return the first Achievement filtered by the category_id column
 *
 * @method     array findById(int $id) Return Achievement objects filtered by the id column
 * @method     array findByName(string $name) Return Achievement objects filtered by the name column
 * @method     array findByDescription(string $description) Return Achievement objects filtered by the description column
 * @method     array findByPoints(int $points) Return Achievement objects filtered by the points column
 * @method     array findByCategoryId(int $category_id) Return Achievement objects filtered by the category_id column
 *
 * @package    propel.generator.rla.om
 */
abstract class BaseAchievementQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseAchievementQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'RLA', $modelName = 'Achievement', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AchievementQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AchievementQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AchievementQuery) {
			return $criteria;
		}
		$query = new AchievementQuery();
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
	 * $obj = $c->findPk(array(12, 34), $con);
	 * </code>
	 *
	 * @param     array[$id, $category_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Achievement|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = AchievementPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(AchievementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Achievement A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `NAME`, `DESCRIPTION`, `POINTS`, `CATEGORY_ID` FROM `achievements` WHERE `ID` = :p0 AND `CATEGORY_ID` = :p1';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
			$stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Achievement();
			$obj->hydrate($row);
			AchievementPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
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
	 * @return    Achievement|array|mixed the result, formatted by the current formatter
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
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(AchievementPeer::ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(AchievementPeer::CATEGORY_ID, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(AchievementPeer::ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(AchievementPeer::CATEGORY_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
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
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AchievementPeer::ID, $id, $comparison);
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
	 * @return    AchievementQuery The current query, for fluid interface
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
		return $this->addUsingAlias(AchievementPeer::NAME, $name, $comparison);
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
	 * @return    AchievementQuery The current query, for fluid interface
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
		return $this->addUsingAlias(AchievementPeer::DESCRIPTION, $description, $comparison);
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
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function filterByPoints($points = null, $comparison = null)
	{
		if (is_array($points)) {
			$useMinMax = false;
			if (isset($points['min'])) {
				$this->addUsingAlias(AchievementPeer::POINTS, $points['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($points['max'])) {
				$this->addUsingAlias(AchievementPeer::POINTS, $points['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AchievementPeer::POINTS, $points, $comparison);
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
	 * @see       filterByCategory()
	 *
	 * @param     mixed $categoryId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function filterByCategoryId($categoryId = null, $comparison = null)
	{
		if (is_array($categoryId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AchievementPeer::CATEGORY_ID, $categoryId, $comparison);
	}

	/**
	 * Filter the query by a related Category object
	 *
	 * @param     Category|PropelCollection $category The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function filterByCategory($category, $comparison = null)
	{
		if ($category instanceof Category) {
			return $this
				->addUsingAlias(AchievementPeer::CATEGORY_ID, $category->getId(), $comparison);
		} elseif ($category instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(AchievementPeer::CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByCategory() only accepts arguments of type Category or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Category relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Category');

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
			$this->addJoinObject($join, 'Category');
		}

		return $this;
	}

	/**
	 * Use the Category relation Category object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CategoryQuery A secondary query class using the current class as primary query
	 */
	public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinCategory($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Category', 'CategoryQuery');
	}

	/**
	 * Filter the query by a related AchievementUser object
	 *
	 * @param     AchievementUser $achievementUser  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function filterByAchievementUser($achievementUser, $comparison = null)
	{
		if ($achievementUser instanceof AchievementUser) {
			return $this
				->addUsingAlias(AchievementPeer::ID, $achievementUser->getAchievementId(), $comparison);
		} elseif ($achievementUser instanceof PropelCollection) {
			return $this
				->useAchievementUserQuery()
				->filterByPrimaryKeys($achievementUser->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByAchievementUser() only accepts arguments of type AchievementUser or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the AchievementUser relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function joinAchievementUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('AchievementUser');

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
			$this->addJoinObject($join, 'AchievementUser');
		}

		return $this;
	}

	/**
	 * Use the AchievementUser relation AchievementUser object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AchievementUserQuery A secondary query class using the current class as primary query
	 */
	public function useAchievementUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinAchievementUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'AchievementUser', 'AchievementUserQuery');
	}

	/**
	 * Filter the query by a related AchievementGroup object
	 *
	 * @param     AchievementGroup $achievementGroup  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function filterByAchievementGroup($achievementGroup, $comparison = null)
	{
		if ($achievementGroup instanceof AchievementGroup) {
			return $this
				->addUsingAlias(AchievementPeer::ID, $achievementGroup->getAchievementId(), $comparison);
		} elseif ($achievementGroup instanceof PropelCollection) {
			return $this
				->useAchievementGroupQuery()
				->filterByPrimaryKeys($achievementGroup->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByAchievementGroup() only accepts arguments of type AchievementGroup or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the AchievementGroup relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function joinAchievementGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('AchievementGroup');

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
			$this->addJoinObject($join, 'AchievementGroup');
		}

		return $this;
	}

	/**
	 * Use the AchievementGroup relation AchievementGroup object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AchievementGroupQuery A secondary query class using the current class as primary query
	 */
	public function useAchievementGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinAchievementGroup($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'AchievementGroup', 'AchievementGroupQuery');
	}

	/**
	 * Filter the query by a related User object
	 * using the achievement_user table as cross reference
	 *
	 * @param     User $user the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = Criteria::EQUAL)
	{
		return $this
			->useAchievementUserQuery()
			->filterByUser($user, $comparison)
			->endUse();
	}

	/**
	 * Filter the query by a related Group object
	 * using the achievement_group table as cross reference
	 *
	 * @param     Group $group the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function filterByGroup($group, $comparison = Criteria::EQUAL)
	{
		return $this
			->useAchievementGroupQuery()
			->filterByGroup($group, $comparison)
			->endUse();
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Achievement $achievement Object to remove from the list of results
	 *
	 * @return    AchievementQuery The current query, for fluid interface
	 */
	public function prune($achievement = null)
	{
		if ($achievement) {
			$this->addCond('pruneCond0', $this->getAliasedColName(AchievementPeer::ID), $achievement->getId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(AchievementPeer::CATEGORY_ID), $achievement->getCategoryId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseAchievementQuery