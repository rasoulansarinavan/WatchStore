<?php

namespace App\Enums;

enum CommentStatuses: string
{
    case Draft = 'draft';
    case Accept = 'accept';
    case Reject = 'reject';
}
