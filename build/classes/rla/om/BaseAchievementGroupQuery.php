<?php


/**
 * Base class that represents a query for the 'achievement_group' table.
 *
 * 
 *
 * @method     AchievementGroupQuery orderByAchievementId($order = Criteria::ASC) Order by the achievement_id column
 * @method     AchievementGroupQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     AchievementGroupQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 *
 * @method     AchievementGroupQuery groupByAchievementId() Group by the achievement_id column
 * @method     AchievementGroupQuery groupByGroupId() Group by the group_id column
 * @method     AchievementGroupQuery groupByWeight() Group by the weight column
 *
 * @method     AchievementGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AchievementGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AchievementGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     AchievementGroupQuery leftJoinAchievement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Achievement relation
 * @method     AchievementGroupQuery rightJoinAchievement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Achievement relation
 * @method     AchievementGroupQuery innerJoinAchievement($relationAlias = null) Adds a INNER JOIN clause to the query using the Achievement relation
 *
 * @method     AchievementGroupQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method     AchievementGroupQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method     AchievementGroupQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method     AchievementGroup findOne(PropelPDO $con = null) Return the first AchievementGroup matching the query
 * @method     AchievementGroup findOneOrCreate(PropelPDO $con = null) Return the first AchievementGroup matching the query, or a new AchievementGroup object populated from the query conditions when no match is found
 *
 * @method     AchievementGroup findOneByAchievementId(int $achievement_id) Return the first AchievementGroup filtered by the achievement_id column
 * @method     AchievementGroup findOneByGroupId(int $group_id) Return the first AchievementGroup filtered by the group_id column
 * @method     AchievementGroup findOneByWeight(int $weight) Return the first AchievementGroup filtered by the weight column
 *
 * @method     array findByAchievementId(int $achievement_id) Return AchievementGroup objects filtered by the achievement_id column
 * @method     array findByGroupId(int $group_id) Return AchievementGroup objects filtered by the group_id column
 * @method     array findByWeight(int $weight) Return AchievementGroup objects filtered by the weight column
 *
 * @package    propel.generator.rla.om
 */
abstract class BaseAchievementGroupQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseAchievementGroupQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'RLA', $modelName = 'AchievementGroup', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AchievementGroupQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AchievementGroupQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AchievementGroupQuery) {
			return $criteria;
		}
		$query = new AchievementGroupQuery();
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
	 * @param     array[$achievement_id, $group_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    AchievementGroup|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = AchievementGroupPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(AchievementGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    AchievementGroup A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ACHIEVEMENT_ID`, `GROUP_ID`, `WEIGHT` FROM `achievement_group` WHERE `ACHIEVEMENT_ID` = :p0 AND `GROUP_ID` = :p1';
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
			$obj = new AchievementGroup();
			$obj->hydrate($row);
			AchievementGroupPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
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
	 * @return    AchievementGroup|array|mixed the result, formatted by the current formatter
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
	 * @return    AchievementGroupQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(AchievementGroupPeer::ACHIEVEMENT_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(AchievementGroupPeer::GROUP_ID, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AchievementGroupQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(AchievementGroupPeer::ACHIEVEMENT_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(AchievementGroupPeer::GROUP_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}

		return $this;
	}

	/**
	 * Filter the query on the achievement_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAchievementId(1234); // WHERE achievement_id = 1234
	 * $query->filterByAchievementId(array(12, 34)); // WHERE achievement_id IN (12, 34)
	 * $query->filterByAchievementId(array('min' => 12)); // WHERE achievement_id > 12
	 * </code>
	 *
	 * @see       filterByAchievement()
	 *
	 * @param     mixed $achievementId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementGroupQuery The current query, for fluid interface
	 */
	public function filterByAchievementId($achievementId = null, $comparison = null)
	{
		if (is_array($achievementId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AchievementGroupPeer::ACHIEVEMENT_ID, $achievementId, $comparison);
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
	 * @return    AchievementGroupQuery The current query, for fluid interface
	 */
	public function filterByGroupId($groupId = null, $comparison = null)
	{
		if (is_array($groupId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AchievementGroupPeer::GROUP_ID, $groupId, $comparison);
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
	 * @return    AchievementGroupQuery The current query, for fluid interface
	 */
	public function filterByWeight($weight = null, $comparison = null)
	{
		if (is_array($weight)) {
			$useMinMax = false;
			if (isset($weight['min'])) {
				$this->addUsingAlias(AchievementGroupPeer::WEIGHT, $weight['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($weight['max'])) {
				$this->addUsingAlias(AchievementGroupPeer::WEIGHT, $weight['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AchievementGroupPeer::WEIGHT, $weight, $comparison);
	}

	/**
	 * Filter the query by a related Achievement object
	 *
	 * @param     Achievement|PropelCollection $achievement The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementGroupQuery The current query, for fluid interface
	 */
	public function filterByAchievement($achievement, $comparison = null)
	{
		if ($achievement instanceof Achievement) {
			return $this
				->addUsingAlias(AchievementGroupPeer::ACHIEVEMENT_ID, $achievement->getId(), $comparison);
		} elseif ($achievement instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(AchievementGroupPeer::ACHIEVEMENT_ID, $achievement->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByAchievement() only accepts arguments of type Achievement or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Achievement relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AchievementGroupQuery The current query, for fluid interface
	 */
	public function joinAchievement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Achievement');

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
			$this->addJoinObject($join, 'Achievement');
		}

		return $this;
	}

	/**
	 * Use the Achievement relation Achievement object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AchievementQuery A secondary query class using the current class as primary query
	 */
	public function useAchievementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinAchievement($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Achievement', 'AchievementQuery');
	}

	/**
	 * Filter the query by a related Group object
	 *
	 * @param     Group|PropelCollection $group The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementGroupQuery The current query, for fluid interface
	 */
	public function filterByGroup($group, $comparison = null)
	{
		if ($group instanceof Group) {
			return $this
				->addUsingAlias(AchievementGroupPeer::GROUP_ID, $group->getId(), $comparison);
		} elseif ($group instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(AchievementGroupPeer::GROUP_ID, $group->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    AchievementGroupQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     AchievementGroup $achievementGroup Object to remove from the list of results
	 *
	 * @return    AchievementGroupQuery The current query, for fluid interface
	 */
	public function prune($achievementGroup = null)
	{
		if ($achievementGroup) {
			$this->addCond('pruneCond0', $this->getAliasedColName(AchievementGroupPeer::ACHIEVEMENT_ID), $achievementGroup->getAchievementId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(AchievementGroupPeer::GROUP_ID), $achievementGroup->getGroupId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseAchievementGroupQuery