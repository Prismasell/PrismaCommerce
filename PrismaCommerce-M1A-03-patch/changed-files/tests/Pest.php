<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

pest()->extend(Tests\TestCase::class)->in('Feature', 'Unit');

pest()->use(RefreshDatabase::class)->in('Feature');
