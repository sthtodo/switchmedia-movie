<?php

use App\Services\MovieFilterService;

class MovieFilterServiceTest extends TestCase
{
    /**
     * @dataProvider recommendProvider
     */
    public function testRecommend($filter, $movies, $params, $expected)
    {
        $this->assertEquals($expected, $filter->recommend($movies, $params));
    }

    public function recommendProvider()
    {
        $filter = new MovieFilterService();
        $movies = $this->data();
        return [
            [$filter, $movies, [], [$movies[0], $movies[2], $movies[1], $movies[3]]],
            [$filter, $movies, ['genre' => 'Drama'], [$movies[0], $movies[2]]],
            [$filter, $movies, ['time' => '19:45'], [$movies[0], $movies[2],  $movies[3]]],
            [$filter, $movies, ['genre' => 'Drama', 'time' => '19:45'], [$movies[0], $movies[2]]],
        ];
    }

    private function data()
    {
        return [
            0 => [
                'name'=> 'Test 1',
                'rating' => 98,
                'genres' => [
                    'Comedy', 'Drama'
                ],
                'showings' => [
                    '20:00:00+11:00',
                    '10:00:00+11:00',
                ]
            ],
            1 => [
                'name'=> 'Test 2',
                'rating' => 75,
                'genres' => [
                    'Comedy'
                ],
                'showings' => [
                    '20:30:00+11:00',
                    '19:00:00+11:00',
                ]
            ],
            2 => [
                'name'=> 'Test 3',
                'rating' => 80,
                'genres' => [
                    'Drama', 'Animation'
                ],
                'showings' => [
                    '19:00:00+11:00',
                    '20:00:00+11:00',
                ]
            ],
            3 => [
                'name'=> 'Test 4',
                'rating' => 70,
                'genres' => [
                    'comedy', 'Animation'
                ],
                'showings' => [
                    '19:30:00+11:00',
                    '20:00:00+11:00',
                ]
            ],
        ];
    }
}