<?php

class CountContollerTest extends TestCase
{

    public function provideIndex()
    {
        $input = [
            'event'     => 'ad.start',
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
        ];

        return [
            [$input, 5]
        ];
    }


    /**
     * @dataProvider provideIndex
     */
    public function testIndex($input, $count)
    {
        $this->truncateStorage($input['event']);
        
        $this->generate($input, time(), $count);

        $this->json('get', 'api/report/count', ['event' => 'ad.start'])
            ->seeJson([
                'total' => $count,
            ]);
    }


    /**
     * Validation error
     */
    public function testIndexValidationError()
    {
        $this->get('api/report/count')
            ->seeJsonStructure([
                'Error'
            ]);
    }

}