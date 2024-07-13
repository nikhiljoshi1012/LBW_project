<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'name' => 'Demo',
                'data' => json_encode('{"cells": {"0-0": "s", "0-1": "r", "0-2": "g", "0-3": "m", "0-4": "p", "1-0": "मध्य्म", "1-1": "वचन", "1-2": "ची", "1-3": "लाज", "1-4": "आहे", "2-0": "d", "2-1": "n", "2-2": "R", "2-3": "slslrLrLgugumUmU", "2-4": ";[", "3-0": "हे ", "3-1": "काय", "3-2": "फाल्तुगिरी", "3-3": "आहे", "3-4": "", "4-0": "", "4-1": "", "4-2": "", "4-3": "", "4-4": "", "5-0": "", "5-1": "", "5-2": "", "5-3": "", "5-4": "", "6-0": "", "6-1": "", "6-2": "", "6-3": "", "6-4": "", "7-0": "", "7-1": "", "7-2": "", "7-3": "", "7-4": "", "8-0": "", "8-1": "", "8-2": "", "8-3": "", "8-4": "", "9-0": "", "9-1": "", "9-2": "", "9-3": "", "9-4": "", "10-0": "", "10-1": "", "10-2": "", "10-3": "", "10-4": "", "11-0": "", "11-1": "", "11-2": "", "11-3": "", "11-4": "", "12-0": "", "12-1": "", "12-2": "", "12-3": "", "12-4": "", "13-0": "", "13-1": "", "13-2": "", "13-3": "", "13-4": ""}, "rowCount": 14, "columnCount": 5}'), 
                'user_id' => 1, // Ensure this user ID exists in your users table
                'visibility' => 'private',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'demo',
                'data' => json_encode(['key' => 'value']),
                'user_id' => 1, // Adjust as necessary
                'visibility' => 'public',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
