<?php


/**
 * Base class that represents a query for the 'archievement_user' table.
 *
 * 
 *
 * @method     ArchievementUserQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ArchievementUserQuery orderByArchievementId($order = Criteria::ASC) Order by the archievement_id column
 *
 * @method     ArchievementUserQuery groupByUserId() Group by the user_id column
 * @method     ArchievementUserQuery groupByArchievementId() Group by the archievement_id column
 *
 * @method     ArchievementUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ArchievementUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ArchievementUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ArchievementUserQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ArchievementUserQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ArchievementUserQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ArchievementUserQuery leftJoinArchievement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Archievement relation
 * @method     ArchievementUserQuery rightJoinArchievement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Archievement relation
 * @method     ArchievementUserQuery innerJoinArchievement($relationAlias = null) Adds a INNER JOIN clause to the query using the Archievement relation
 *
 * @method     ArchievementUser findOne(PropelPDO $con = null) Return the first ArchievementUser matching the query
 * @method     ArchievementUser findOneOrCreate(PropelPDO $con = null) Return the first ArchievementUser matching the query, or a new ArchievementUser object populated from the query conditions when no match is found
 *
 * @method     ArchievementUser findOneByUserId(int $user_id) Return the first ArchievementUser filtered by the user_id column
 * @method     ArchievementUser findOneByArchievementId(int $archievement_id) Return the first ArchievementUser filtered by the archievement_id column
 *
 * @method     array findByUserId(int $user_id) Return ArchievementUser objects filtered by the user_id column
 * @method     array findByArchievementId(int $archievement_id) Return ArchievementUser objects filtered by the archievement_id column
 *
 * @package    propel.generator.rla.om
 */
abstract class BaseArchievementUserQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseArchievementUserQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'RLA', $modelName = 'ArchievementUser', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ArchievementUserQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ArchievementUserQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ArchievementUserQuery) {
			return $criteria;
		}
		$query = new ArchievementUserQuery();
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
	 * @param     array[$user_id, $archievement_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    ArchievementUser|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ArchievementUserPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ArchievementUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    ArchievementUser A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `USER_ID`, `ARCHIEVEMENT_ID` FROM `archievement_user` WHERE `USER_ID` = :p0 AND `ARCHIEVEMENT_ID` = :p1';
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
			$obj = new ArchievementUser();
			$obj->hydrate($row);
			ArchievementUserPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
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
	 * @return    ArchievementUser|array|mixed the result, formatted by the current formatter
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
	 * @return    ArchievementUserQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(ArchievementUserPeer::USER_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(ArchievementUserPeer::ARCHIEVEMENT_ID, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ArchievementUserQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(ArchievementUserPeer::USER_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(ArchievementUserPeer::ARCHIEVEMENT_ID, $key[1], Criteria::EQUAL);
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
	 * @return    ArchievementUserQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArchievementUserPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the archievement_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByArchievementId(1234); // WHERE archievement_id = 1234
	 * $query->filterByArchievementId(array(12, 34)); // WHERE archievement_id IN (12, 34)
	 * $query->filterByArchievementId(array('min' => 12)); // WHERE archievement_id > 12
	 * </code>
	 *
	 * @see       filterByArchievement()
	 *
	 * @param     mixed $archievementId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementUserQuery The current query, for fluid interface
	 */
	public function filterByArchievementId($archievementId = null, $comparison = null)
	{
		if (is_array($archievementId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArchievementUserPeer::ARCHIEVEMENT_ID, $archievementId, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementUserQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(ArchievementUserPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ArchievementUserPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    ArchievementUserQuery The current query, for fluid interface
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
	 * Filter the query by a related Archievement object
	 *
	 * @param     Archievement|PropelCollection $archievement The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchievementUserQuery The current query, for fluid interface
	 */
	public function filterByArchievement($archievement, $comparison = null)
	{
		if ($archievement instanceof Archievement) {
			return $this
				->addUsingAlias(ArchievementUserPeer::ARCHIEVEMENT_ID, $archievement->getId(), $comparison);
		} elseif ($archievement instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ArchievementUserPeer::ARCHIEVEMENT_ID, $archievement->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByArchievement() only accepts arguments of type Archievement or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Archievement relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArchievementUserQuery The current query, for fluid interface
	 */
	public function joinArchievement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Archievement');

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
			$this->addJoinObject($join, 'Archievement');
		}

		return $this;
	}

	/**
	 * Use the Archievement relation Archievement object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArchievementQuery A secondary query class using the current class as primary query
	 */
	public function useArchievementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinArchievement($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Archievement', 'ArchievementQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     ArchievementUser $archievementUser Object to remove from the list of results
	 *
	 * @return    ArchievementUserQuery The current query, for fluid interface
	 */
	public function prune($archievementUser = null)
	{
		if ($archievementUser) {
			$this->addCond('pruneCond0', $this->getAliasedColName(ArchievementUserPeer::USER_ID), $archievementUser->getUserId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(ArchievementUserPeer::ARCHIEVEMENT_ID), $archievementUser->getArchievementId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseArchievementUserQuery