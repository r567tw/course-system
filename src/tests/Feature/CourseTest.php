<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Course;
use App\Models\Teacher;

class CourseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_course_list(): void
    {
        Course::factory()->count(3)->create();
        $response = $this->get('/api/courses');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_course_creation(): void
    {
        $teacher = Teacher::factory()->create();
        $response = $this->postJson('/api/courses', [
            'name' => 'Course 1',
            'start' => '15:00',
            'description' => 'Description 1',
            'teacher_id' => $teacher->id,
        ]);

        $this->assertDatabaseHas('courses', ['name' => 'Course 1']);
        $response->assertStatus(201)->assertJsonStructure(['id']);
    }

    public function test_course_update(): void
    {
        $course = Course::factory()->create();
        $response = $this->putJson("/api/courses/{$course->id}", [
            'name' => 'Course Updated',
            'start' => '16:00',
            'description' => 'Description 2',
            'teacher_id' => $course->teacher_id,
        ]);

        $this->assertDatabaseHas('courses', ['name' => 'Course Updated']);
        $response->assertStatus(200);
    }
}
