<?php


/**
 * Base class that represents a query for the 'achievement_user' table.
 *
 * 
 *
 * @method     AchievementUserQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     AchievementUserQuery orderByAchievementId($order = Criteria::ASC) Order by the achievement_id column
 * @method     AchievementUserQuery orderByConfirmed($order = Criteria::ASC) Order by the confirmed column
 * @method     AchievementUserQuery orderByDate($order = Criteria::ASC) Order by the date column
 *
 * @method     AchievementUserQuery groupByUserId() Group by the user_id column
 * @method     AchievementUserQuery groupByAchievementId() Group by the achievement_id column
 * @method     AchievementUserQuery groupByConfirmed() Group by the confirmed column
 * @method     AchievementUserQuery groupByDate() Group by the date column
 *
 * @method     AchievementUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AchievementUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AchievementUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     AchievementUserQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     AchievementUserQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     AchievementUserQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     AchievementUserQuery leftJoinAchievement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Achievement relation
 * @method     AchievementUserQuery rightJoinAchievement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Achievement relation
 * @method     AchievementUserQuery innerJoinAchievement($relationAlias = null) Adds a INNER JOIN clause to the query using the Achievement relation
 *
 * @method     AchievementUser findOne(PropelPDO $con = null) Return the first AchievementUser matching the query
 * @method     AchievementUser findOneOrCreate(PropelPDO $con = null) Return the first AchievementUser matching the query, or a new AchievementUser object populated from the query conditions when no match is found
 *
 * @method     AchievementUser findOneByUserId(int $user_id) Return the first AchievementUser filtered by the user_id column
 * @method     AchievementUser findOneByAchievementId(int $achievement_id) Return the first AchievementUser filtered by the achievement_id column
 * @method     AchievementUser findOneByConfirmed(boolean $confirmed) Return the first AchievementUser filtered by the confirmed column
 * @method     AchievementUser findOneByDate(string $date) Return the first AchievementUser filtered by the date column
 *
 * @method     array findByUserId(int $user_id) Return AchievementUser objects filtered by the user_id column
 * @method     array findByAchievementId(int $achievement_id) Return AchievementUser objects filtered by the achievement_id column
 * @method     array findByConfirmed(boolean $confirmed) Return AchievementUser objects filtered by the confirmed column
 * @method     array findByDate(string $date) Return AchievementUser objects filtered by the date column
 *
 * @package    propel.generator.rla.om
 */
abstract class BaseAchievementUserQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseAchievementUserQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'RLA', $modelName = 'AchievementUser', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AchievementUserQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AchievementUserQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AchievementUserQuery) {
			return $criteria;
		}
		$query = new AchievementUserQuery();
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
	 * @param     array[$user_id, $achievement_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    AchievementUser|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = AchievementUserPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(AchievementUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    AchievementUser A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `USER_ID`, `ACHIEVEMENT_ID`, `CONFIRMED`, `DATE` FROM `achievement_user` WHERE `USER_ID` = :p0 AND `ACHIEVEMENT_ID` = :p1';
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
			$obj = new AchievementUser();
			$obj->hydrate($row);
			AchievementUserPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
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
	 * @return    AchievementUser|array|mixed the result, formatted by the current formatter
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
	 * @return    AchievementUserQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(AchievementUserPeer::USER_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(AchievementUserPeer::ACHIEVEMENT_ID, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AchievementUserQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(AchievementUserPeer::USER_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(AchievementUserPeer::ACHIEVEMENT_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}

		return $this;
	}

	/**
	 * Filter the query on the user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserId(1234); // WHERE user_id = 1234
	 * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
	 * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
	 * </code>
	 *
	 * @see       filterByUser()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementUserQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AchievementUserPeer::USER_ID, $userId, $comparison);
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
	 * @return    AchievementUserQuery The current query, for fluid interface
	 */
	public function filterByAchievementId($achievementId = null, $comparison = null)
	{
		if (is_array($achievementId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AchievementUserPeer::ACHIEVEMENT_ID, $achievementId, $comparison);
	}

	/**
	 * Filter the query on the confirmed column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByConfirmed(true); // WHERE confirmed = true
	 * $query->filterByConfirmed('yes'); // WHERE confirmed = true
	 * </code>
	 *
	 * @param     boolean|string $confirmed The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementUserQuery The current query, for fluid interface
	 */
	public function filterByConfirmed($confirmed = null, $comparison = null)
	{
		if (is_string($confirmed)) {
			$confirmed = in_array(strtolower($confirmed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(AchievementUserPeer::CONFIRMED, $confirmed, $comparison);
	}

	/**
	 * Filter the query on the date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
	 * $query->filterByDate('now'); // WHERE date = '2011-03-14'
	 * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $date The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementUserQuery The current query, for fluid interface
	 */
	public function filterByDate($date = null, $comparison = null)
	{
		if (is_array($date)) {
			$useMinMax = false;
			if (isset($date['min'])) {
				$this->addUsingAlias(AchievementUserPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($date['max'])) {
				$this->addUsingAlias(AchievementUserPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AchievementUserPeer::DATE, $date, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementUserQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(AchievementUserPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(AchievementUserPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AchievementUserQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('User');

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
			$this->addJoinObject($join, 'User');
		}

		return $this;
	}

	/**
	 * Use the User relation User object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Filter the query by a related Achievement object
	 *
	 * @param     Achievement|PropelCollection $achievement The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AchievementUserQuery The current query, for fluid interface
	 */
	public function filterByAchievement($achievement, $comparison = null)
	{
		if ($achievement instanceof Achievement) {
			return $this
				->addUsingAlias(AchievementUserPeer::ACHIEVEMENT_ID, $achievement->getId(), $comparison);
		} elseif ($achievement instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(AchievementUserPeer::ACHIEVEMENT_ID, $achievement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    AchievementUserQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     AchievementUser $achievementUser Object to remove from the list of results
	 *
	 * @return    AchievementUserQuery The current query, for fluid interface
	 */
	public function prune($achievementUser = null)
	{
		if ($achievementUser) {
			$this->addCond('pruneCond0', $this->getAliasedColName(AchievementUserPeer::USER_ID), $achievementUser->getUserId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(AchievementUserPeer::ACHIEVEMENT_ID), $achievementUser->getAchievementId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseAchievementUserQuery