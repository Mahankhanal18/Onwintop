<?php
//Error Reporting

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Josantonius\Cookie\Cookie;

$cookie = new Cookie();

$DIR='/onwintop';

require_once "router.php";
get($DIR.'/','login.php');
//get($DIR.'/signin','login.php');
//get($DIR.'/signup','register.php');
post($DIR.'/','login.php');
//post($DIR.'/signup','register.php');
//post($DIR.'/signin','login.php');

//Provision
get($DIR.'/signup','provision/account-details.php');
post($DIR.'/signup','provision/account-details.php');
get($DIR.'/choose-theme','provision/theme.php');
post($DIR.'/choose-theme','provision/theme.php');
get($DIR.'/nft','provision/nft.php');
post($DIR.'/nft','provision/nft.php');

get($DIR.'/payment','provision/payment.php');
post($DIR.'/payment','provision/payment.php');

get($DIR.'/provision-success','provision-success.php');
post($DIR.'/provision-success','provision-success.php');

get($DIR.'/test-payment','test-payment.php');
post($DIR.'/test-payment','test-payment.php');

get($DIR.'/$community_id/choose-subscription', 'challenge-focus/plans.php');
post($DIR.'/$community_id/choose-subscription', 'challenge-focus/plans.php');

get($DIR.'/$community_id/pay', 'challenge-focus/pay.php');
post($DIR.'/$community_id/pay', 'challenge-focus/pay.php');

get($DIR.'/$community_id/success-payment', 'challenge-focus/success-payment.php');
post($DIR.'/$community_id/success-payment', 'challenge-focus/success-payment.php');

get($DIR.'/$community_id/redeem-reward/$red', 'redeem-reward.php');
post($DIR.'/$community_id/redeem-reward/$red', 'redeem-reward.php');

//other
get($DIR.'/social-preview/$data','includes/social-preview/index.php');

get($DIR.'/$community_id', 'index.php');

get($DIR.'/$community_id/challenge-complete', 'challange-complete.php');

get($DIR.'/$community_id/pending-challenges', 'pending-challenges.php');
post($DIR.'/$community_id/pending-challenges', 'pending-challenges.php');

get($DIR.'/$community_id/completed-challenges', 'completed-challenges.php');
post($DIR.'/$community_id/completed-challenges', 'completed-challenges.php');

get($DIR.'/$community_id/explore', 'explore.php');
get($DIR.'/$community_id/signin', 'sign-in.php');
get($DIR.'/$community_id/signup', 'signup.php');
post($DIR.'/$community_id/signin', 'sign-in.php');
post($DIR.'/$community_id/signup', 'signup.php');
get($DIR.'/$community_id/search/$keyword', 'search.php');

get($DIR.'/$community_id/forgot-password', 'forgot.php');
post($DIR.'/$community_id/forgot-password', 'forgot.php');

//challenge focus



get($DIR.'/$community_id/challange-focus', 'discussion-new.php');
post($DIR.'/$community_id/challange-focus', 'discussion-new.php');

get($DIR.'/$community_id/challange-focus/discussions', 'discussion-new.php');
post($DIR.'/$community_id/challange-focus/discussions', 'discussion-new.php');

get($DIR.'/$community_id/challange-focus/challenges', 'challenges-new.php');
post($DIR.'/$community_id/challange-focus/challenges', 'challenges-new.php');

get($DIR.'/$community_id/reset-password/$data', 'reset-password.php');
post($DIR.'/$community_id/reset-password/$data', 'reset-password.php');

get($DIR.'/$community_id/challenges-confirmation', 'challenges-confirmation.php');
post($DIR.'/$community_id/challenges-confirmation', 'challenges-confirmation.php');

//Discussion Modules
get($DIR.'/$community_id/discussions', 'discussions.php');
get($DIR.'/$community_id/discussions/$page', 'discussions.php');
get($DIR.'/$community_id/discussions/search/$search', 'discussions.php');
get($DIR.'/$community_id/discussion/$discussion_id', 'discussion.php');
get($DIR.'/$community_id/create-topic', 'create-topic.php');
post($DIR.'/$community_id/create-topic', 'create-topic.php');
get($DIR.'/$community_id/edit-topic/$id', 'create-topic.php');
post($DIR.'/$community_id/edit-topic/$id', 'create-topic.php');




//Blogs Modules
get($DIR.'/$community_id/blogs', 'blogs.php');
get($DIR.'/$community_id/blogs/$page', 'blogs.php');
get($DIR.'/$community_id/view-blogs/$page', 'view-blogs.php');
get($DIR.'/$community_id/view-blogs', 'view-blogs.php');

get($DIR.'/$community_id/pending-blogs', 'pending-blogs.php');

get($DIR.'/$community_id/ai-writters', 'ai-writters.php');
post($DIR.'/$community_id/ai-writters', 'ai-writters.php');
get($DIR.'/$community_id/ai-writter', 'ai-writter.php');
post($DIR.'/$community_id/ai-writter', 'ai-writter.php');
get($DIR.'/$community_id/ai-writter/$id', 'ai-writter.php');
post($DIR.'/$community_id/ai-writter/$id', 'ai-writter.php');

get($DIR.'/$community_id/create-blog', 'create-blog.php');
post($DIR.'/$community_id/create-blog', 'create-blog.php');
get($DIR.'/$community_id/edit-blog/$id', 'create-blog.php');
post($DIR.'/$community_id/edit-blog/$id', 'create-blog.php');
get($DIR.'/$community_id/blog/$id', 'blog-detail.php');

//Challenge Module
get($DIR.'/$community_id/challenge/$id', 'challenge.php');
get($DIR.'/$community_id/review-challenge/$id', 'review-challenge.php');
post($DIR.'/$community_id/review-challenge/$id', 'review-challenge.php');

//Events Modules
get($DIR.'/$community_id/events', 'events.php');
get($DIR.'/$community_id/events/type/$type', 'events.php');
get($DIR.'/$community_id/events/category/$category', 'events.php');
get($DIR.'/$community_id/events/$page', 'events.php');
get($DIR.'/$community_id/event/$id', 'event-detail.php');
get($DIR.'/$community_id/view-events', 'view-events.php');
get($DIR.'/$community_id/view-events/$page', 'view-events.php');
get($DIR.'/$community_id/create-event', 'create-event.php');
post($DIR.'/$community_id/create-event', 'create-event.php');
get($DIR.'/$community_id/edit-event/$id', 'create-event.php');
post($DIR.'/$community_id/edit-event/$id', 'create-event.php');
get($DIR.'/$community_id/manage-event/$id', 'manage-event.php');
post($DIR.'/$community_id/manage-event/$id', 'manage-event.php');

get($DIR.'/new-community/$data', 'new-community.php');
post($DIR.'/new-community/$data', 'new-community.php');

//Channels Modules
get($DIR.'/$community_id/channels', 'channels.php');
get($DIR.'/$community_id/channels/$page', 'channels.php');
get($DIR.'/$community_id/channel/$id', 'channel.php');
get($DIR.'/$community_id/channel/$id/$page', 'channel.php');
get($DIR.'/$community_id/create-channel', 'create-channel.php');
get($DIR.'/$community_id/edit-channel-info/$id', 'create-channel.php');
post($DIR.'/$community_id/create-channel', 'create-channel.php');
post($DIR.'/$community_id/edit-channel-info/$id', 'create-channel.php');
get($DIR.'/$community_id/edit-channel/$id', 'edit-channel.php');

get($DIR.'/$community_id/create-community', 'create-community.php');
post($DIR.'/$community_id/create-community', 'create-community.php');

//Challenges
get($DIR.'/$community_id/challenges', 'challenges.php');
get($DIR.'/$community_id/challenges/$page', 'channels.php');
get($DIR.'/$community_id/challenge/$id', 'challenge.php');
post($DIR.'/$community_id/challenge/$id', 'challenge.php');
get($DIR.'/$community_id/create-challenge', 'create-challenge.php');
get($DIR.'/$community_id/edit-challenge/$id', 'create-challenge.php');
post($DIR.'/$community_id/create-challenge', 'create-challenge.php');
post($DIR.'/$community_id/edit-challenge/$id', 'create-challenge.php');


//Rewards
get($DIR.'/$community_id/rewards', 'rewards.php');
get($DIR.'/$community_id/rewards/$page', 'rewards.php');
get($DIR.'/$community_id/reward/$id', 'reward.php');
get($DIR.'/$community_id/create-reward', 'create-reward.php');
get($DIR.'/$community_id/edit-reward/$id', 'create-reward.php');
post($DIR.'/$community_id/create-reward', 'create-reward.php');
post($DIR.'/$community_id/edit-reward/$id', 'create-reward.php');



get($DIR.'/$community_id/redeemption/$id', 'redeemption.php');
post($DIR.'/$community_id/redeemption/$id', 'redeemption.php');

get($DIR.'/$community_id/successful-redemption', 'successful-redemption.php');
post($DIR.'/$community_id/successful-redemption', 'successful-redemption.php');




//Contents Module

get($DIR.'/$community_id/videos', 'videos.php');

get($DIR.'/$community_id/file/$id', 'file-detail.php');
get($DIR.'/$community_id/video/$project/$id', 'video.php');
post($DIR.'/$community_id/video/$project/$id', 'video.php');
get($DIR.'/$community_id/video-campaign/$id', 'video-campaign.php');
get($DIR.'/$community_id/video-projects', 'video-projects.php');
post($DIR.'/$community_id/video-projects', 'video-projects.php');
//get($DIR.'/$community_id/video/$id', 'video.php');
get($DIR.'/$community_id/video-project/$id', 'video-project.php');
post($DIR.'/$community_id/video-project/$id', 'video-project.php');
get($DIR.'/$community_id/video-config-ai/$id', 'video-ai-config.php');
post($DIR.'/$community_id/video-config-ai/$id', 'video-ai-config.php');

//Create Video Upload Invitation Page
get($DIR.'/$community_id/create-video-invitation/$id', 'create-video-invitation-1.php');
post($DIR.'/$community_id/create-video-invitation/$id', 'create-video-invitation-1.php');

get($DIR.'/$community_id/pending-videos', 'pending-videos.php');
post($DIR.'/$community_id/pending-videos', 'pending-videos.php');

get($DIR.'/$community_id/collect-video-information/$id', 'create-video-invitation-2.php');
post($DIR.'/$community_id/collect-video-information/$id', 'create-video-invitation-2.php');

get($DIR.'/$community_id/thank-video-contributor/$id', 'create-video-invitation-3.php');
post($DIR.'/$community_id/thank-video-contributor/$id', 'create-video-invitation-3.php');

get($DIR.'/$community_id/video-project-informations/$id', 'video-project-informations.php');
post($DIR.'/$community_id/video-project-informations/$id', 'video-project-informations.php');

//Video Invitaition Page
get($DIR.'/$community_id/video-invitation/$type/$id', 'video-invitation-1.php');

get($DIR.'/$community_id/upload-invitation/$id', 'video-invitation.php');
post($DIR.'/$community_id/upload-invitation/$id', 'video-invitation.php');

//Video Branding Editor
get($DIR.'/$community_id/video-branding/$id', 'video-branding.php');
post($DIR.'/$community_id/video-branding/$id', 'video-branding.php');

//Video Layer Editor
get($DIR.'/$community_id/video-editor/$id', 'video-editor.php');
post($DIR.'/$community_id/video-editor/$id', 'video-editor.php');

get($DIR.'/$community_id/make-video-masking/$id', 'make-video-masking.php');
post($DIR.'/$community_id/make-video-masking/$id', 'make-video-masking.php');

get($DIR.'/$community_id/solution/$id', 'solution-detail.php');

get($DIR.'/$community_id/create-file/$channel_id', 'create-file.php');
post($DIR.'/$community_id/create-file/$channel_id', 'create-file.php');
get($DIR.'/$community_id/edit-file/$channel_id', 'create-file.php');
post($DIR.'/$community_id/edit-file/$channel_id', 'create-file.php');

get($DIR.'/$community_id/create-video/$channel_id', 'create-video.php');
post($DIR.'/$community_id/create-video/$channel_id', 'create-video.php');
get($DIR.'/$community_id/edit-video/$channel_id', 'create-video.php');
post($DIR.'/$community_id/edit-video/$channel_id', 'create-video.php');

get($DIR.'/$community_id/create-solution/$channel_id', 'create-solution.php');
post($DIR.'/$community_id/create-solution/$channel_id', 'create-solution.php');
get($DIR.'/$community_id/edit-solution/$channel_id', 'create-solution.php');
post($DIR.'/$community_id/edit-solution/$channel_id', 'create-solution.php');

//Salesrooms Modules
get($DIR.'/$community_id/salesrooms', 'salesrooms.php');
get($DIR.'/$community_id/salesrooms/$page', 'salesrooms.php');
get($DIR.'/$community_id/view-salesrooms/$page', 'view-salesrooms.php');
get($DIR.'/$community_id/view-salesrooms', 'view-salesrooms.php');
get($DIR.'/$community_id/create-salesroom', 'create-salesroom.php');
post($DIR.'/$community_id/create-salesroom', 'create-salesroom.php');
get($DIR.'/$community_id/edit-salesroom/$id', 'create-salesroom.php');
post($DIR.'/$community_id/edit-salesroom/$id', 'create-salesroom.php');
get($DIR.'/$community_id/salesroom/$id', 'salesroom.php');

//Admin Modules
get($DIR.'/$community_id/view-members', 'view-members.php');
get($DIR.'/$community_id/landing-page', 'landing-page.php');
get($DIR.'/$community_id/landing-page', 'landing-page.php');
get($DIR.'/$community_id/edit-header', 'header-page.php');
post($DIR.'/$community_id/edit-header', 'header-page.php');
get($DIR.'/$community_id/custom-code', 'custom-code.php');
post($DIR.'/$community_id/custom-code', 'custom-code.php');
get($DIR.'/$community_id/branding-settings', 'branding-edit.php');
post($DIR.'/$community_id/branding-settings', 'branding-edit.php');
get($DIR.'/$community_id/sharing', 'sharing.php');
get($DIR.'/$community_id/edit-settings', 'edit-settings.php');
post($DIR.'/$community_id/edit-settings', 'edit-settings.php');

get($DIR.'/$community_id/registration-questions', 'registration-questions.php');
post($DIR.'/$community_id/registration-questions', 'registration-questions.php');
get($DIR.'/$invite_id/invite', 'invite.php');
post($DIR.'/$invite_id/invite', 'invite.php');

//Member Modules
get($DIR.'/$community_id/profile', 'profile.php');
get($DIR.'/$community_id/settings', 'settings.php');
post($DIR.'/$community_id/settings', 'settings.php');
get($DIR.'/$community_id/login-as-member', 'login-as-member.php');

get($DIR.'/$community_id/logout', 'logout.php');

//wallet.php

//SuperAdmin Modules
get($DIR.'/admin/account-wallet/$community_id', 'wallet.php');
post($DIR.'/admin/account-wallet/$community_id', 'wallet.php');

get($DIR.'/admin/account-admin/$community_id', 'admin-settings.php');
get($DIR.'/admin/account-admin', 'admin-settings.php');
get($DIR.'/admin/admin-users', 'admin-users.php');
post($DIR.'/admin/admin-users', 'admin-users.php');
get($DIR.'/admin/admin-api-clients', 'admin-api-clients.php');
get($DIR.'/admin/admin-close-account', 'admin-close-account.php');

//Making route to a new page
get($DIR.'/$community_id/sample-page', 'sample-page.php');
post($DIR.'/$community_id/sample-page', 'sample-page.php');


any('/404', '404.php');
?>

