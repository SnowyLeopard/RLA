<?php 

require_once '../bootstrap.php';

// Clear the database.
echo "Clearing database...<br />";
$query = file_get_contents('../build/sql/schema.sql');
$connection = Propel::getConnection();
$connection->prepare($query)->execute();

// Categories.
echo "Adding categories...<br />";
$cat1 = new Category();
$cat1->setName('General');
$cat1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
$cat1->save();

$cat2 = new Category();
$cat2->setName('Other');
$cat2->setDescription('Etiam pellentesque aliquet scelerisque.');
$cat2->save();

// Groups.
echo "Adding groups...<br />";
$group1 = new Group();
$group1->setName('Group 1');
$group1->setDescription('Praesent in libero in quam adipiscing ullamcorper.');
$group1->setCategory($cat1);
$group1->setGroupType('group');
$group1->save();

$group2 = new Group();
$group2->setName('Group 2');
$group2->setDescription('Cras venenatis tortor quis nunc vehicula accumsan.');
$group2->setCategory($cat2);
$group2->setGroupType('chain');
$group2->save();

// Achievements.
echo "Adding achievements...<br />";
$ach11 = new Achievement();
$ach11->setName('Achievement 1.1');
$ach11->setDescription('Aliquam erat volutpat.');
$ach11->setPoints(10);
$ach11->setCategory($cat1);
$ach11->addGroup($group1);
$ach11->save();

$ach12 = new Achievement();
$ach12->setName('Achievement 1.2');
$ach12->setDescription('Curabitur enim tortor, mollis vulputate sagittis eu, imperdiet ut nulla.');
$ach12->setPoints(10);
$ach12->setCategory($cat1);
$ach12->addGroup($group1);
$ach12->save();

$ach13 = new Achievement();
$ach13->setName('Achievement 1.3');
$ach13->setDescription('Cras condimentum vulputate euismod.');
$ach13->setPoints(25);
$ach13->setCategory($cat1);
$ach13->addGroup($group1);
$ach13->save();

$ach21 = new Achievement();
$ach21->setName('Achievement 2.1');
$ach21->setDescription('Nunc sit amet augue eu est porta faucibus.');
$ach21->setPoints(10);
$ach21->setCategory($cat2);
$ach21->addGroup($group2);
$ach21->save();

$ach22 = new Achievement();
$ach22->setName('Achievement 2.2');
$ach22->setDescription('Nunc pellentesque blandit imperdiet.');
$ach22->setPoints(10);
$ach22->setCategory($cat2);
$ach22->addGroup($group2);
$ach22->save();

$ach23 = new Achievement();
$ach23->setName('Achievement 2.3');
$ach23->setDescription('Proin sit amet turpis quis purus vestibulum rutrum.');
$ach23->setPoints(25);
$ach23->setCategory($cat2);
$ach23->addGroup($group2);
$ach23->save();

// Users.
echo "Adding users...<br />";
$user1 = new User();
$user1->setUsername('Nullam vitae justo metus, eget pulvinar erat.');
$user1->setPassword('');
$user1->setHash('');
$user1->setLevel('user');
$user1->addAchievement($ach11);
$user1->addAchievement($ach12);
$user1->addAchievement($ach22);
$user1->save();

$user2 = new User();
$user2->setUsername('Maecenas ac tortor porttitor risus ultricies elementum.');
$user2->setPassword('');
$user2->setHash('');
$user2->setLevel('mod');
$user1->addAchievement($ach11);
$user1->addAchievement($ach12);
$user1->addAchievement($ach13);
$user1->addAchievement($ach21);
$user1->addAchievement($ach22);
$user1->addAchievement($ach23);
$user2->save();

echo "Done!";
