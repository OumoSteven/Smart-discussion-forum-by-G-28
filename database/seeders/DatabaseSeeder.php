<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use App\Models\Membership;
use App\Models\Topic;
use App\Models\Post;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\ParticipationMark;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---------- Users ----------
        $lecturer = User::firstOrCreate(
            ['email' => 'namuwendojudithmukisa@gmail.com'],
            [
                'name'     => 'Namuwendo Judith Mukisa',
                'password' => Hash::make('password'),
                'role'     => 'lecturer',
                'status'   => 'active',
            ]
        );

        $students = collect([
            ['name' => 'Grace Nakato', 'email' => 'grace.nakato@student.mak.ac.ug'],
            ['name' => 'Brian Okello', 'email' => 'brian.okello@student.mak.ac.ug'],
            ['name' => 'Faith Nabirye', 'email' => 'faith.nabirye@student.mak.ac.ug'],
            ['name' => 'Kevin Ssemwogerere', 'email' => 'kevin.ssemwogerere@student.mak.ac.ug'],
        ])->map(fn ($s) => User::firstOrCreate(
            ['email' => $s['email']],
            [
                'name'     => $s['name'],
                'password' => Hash::make('password'),
                'role'     => 'member',
                'status'   => 'active',
            ]
        ));

        // ---------- Group ----------
        $group = Group::firstOrCreate(
            ['name' => 'Software Engineering A'],
            ['created_by' => $lecturer->id]
        );

        // ---------- Memberships ----------
        foreach ($students as $i => $student) {
            Membership::firstOrCreate(
                ['user_id' => $student->id, 'group_id' => $group->group_id],
                [
                    'status'         => 'active',
                    'warnings_count' => 0,
                    'last_active_at' => now()->subHours($i + 1),
                    'agreed_rules'   => true,
                    'joined_at'      => now()->subDays(30 - $i),
                ]
            );
        }

        // ---------- Topics + Posts ----------
        $topic1 = Topic::firstOrCreate(
            ['title' => 'Database Design Principles', 'group_id' => $group->group_id],
            ['created_by' => $students[0]->id, 'category' => 'Databases', 'is_resolved' => false]
        );

        Post::firstOrCreate(
            ['topic_id' => $topic1->topic_id, 'author_id' => $students[0]->id, 'body' => "Don't forget to normalize to 3NF before submitting."],
            ['is_question' => false, 'is_answer' => false, 'relevance_score' => 1]
        );

        $topic2 = Topic::firstOrCreate(
            ['title' => 'Artificial Intelligence Ethics', 'group_id' => $group->group_id],
            ['created_by' => $students[3]->id, 'category' => 'AI', 'is_resolved' => false]
        );

        Post::firstOrCreate(
            ['topic_id' => $topic2->topic_id, 'author_id' => $students[3]->id, 'body' => 'Does anyone have sources on bias in training data?'],
            ['is_question' => true, 'is_answer' => false, 'relevance_score' => 1]
        );

        // ---------- Quizzes + Questions ----------
        $quiz1 = Quiz::firstOrCreate(
            ['title' => 'Normalization & ER Modeling', 'group_id' => $group->group_id],
            [
                'lecturer_id'      => $lecturer->id,
                'start_at'         => now()->addDay(),
                'duration_minutes' => 30,
                'target_category'  => 'Databases',
                'status'           => 'draft',
            ]
        );

        Question::firstOrCreate(
            ['quiz_id' => $quiz1->quiz_id, 'text' => 'What does 3NF eliminate?'],
            [
                'options'        => ['A' => 'Redundancy', 'B' => 'Indexes', 'C' => 'Foreign keys', 'D' => 'Views'],
                'correct_option' => 'A',
                'marks'          => 1,
            ]
        );

        $quiz2 = Quiz::firstOrCreate(
            ['title' => 'OSI vs TCP/IP Layers', 'group_id' => $group->group_id],
            [
                'lecturer_id'      => $lecturer->id,
                'start_at'         => now()->addDays(3),
                'duration_minutes' => 20,
                'target_category'  => 'Networks',
                'status'           => 'open',
            ]
        );

        // ---------- Participation marks ----------
        foreach ($students as $i => $student) {
            ParticipationMark::firstOrCreate(
                ['user_id' => $student->id, 'group_id' => $group->group_id, 'period' => 'Term 1'],
                ['criteria' => 'Forum activity', 'score' => [88, 61, 79, 24][$i]]
            );
        }

        // ---------- Notifications ----------
        Notification::firstOrCreate(
            ['user_id' => $lecturer->id, 'type' => 'quiz_scheduled'],
            ['payload' => ['message' => 'Your quiz "OSI vs TCP/IP Layers" is now open.']]
        );
    }
}