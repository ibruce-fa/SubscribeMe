<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class S3FolderTypes extends Model
{
    const PLAN_FEATURED_PHOTO = 'plan-featured-photo/';

    const PLAN_GALLERY_PHOTO = 'plan-gallery-photo/';

    const BUSINESS_PHOTO = 'business-photo/';

    const BUSINESS_LOGO = 'business-logo/';
    
    const LOGOS = 'logos/';

}
