<?php

namespace App\DTOs\Lessons;

class BookLessonDto
{
    public function __construct(public int $userId, public int $lessonId)
    {
    }
}
