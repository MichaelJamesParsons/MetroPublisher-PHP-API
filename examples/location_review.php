<?php
use MetroPublisher\MetroPublisher;
use MetroPublisher\Api\Models\LocationReview;

require "./config.php";

$metroPublisher = new MetroPublisher(MP_API_KEY, MP_API_SECRET);
$metroPublisher->getHttpClient()->setSslVerification(false);

// Create
$locationReview = new LocationReview($metroPublisher, '55547ff8-3355-4f69-a867-7232165e6d29');
$locationReview->setUrlname('book-review')
               ->setTitle('Book Review')
               ->setMetaTitle('Lorem Ipsum')
               ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
               ->setMetaDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
               ->setPrintDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
               ->setContent('<p>Quisque sed erat sed ex eleifend sollicitudin eu id ligula.</p>')
               ->setFeatureImageUuid(null)
               ->setTeaserImageUuid(null)
               ->setIssued(new DateTime('now'))
               ->setEvergreen(true)
               ->setRating(4.5)
               ->setLocationUuid(null);

// Save
$locationReview->save();

// Delete
$locationReview->delete();