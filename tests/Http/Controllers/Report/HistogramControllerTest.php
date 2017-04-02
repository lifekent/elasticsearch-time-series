<?php

class CountContollerTest extends TestCase
{
    public function provideIndex()
    {
        $input = [
            'event'     => 'audio.start',
            'domain'    => 'agently.io',
            'url'       => 'agently.io/apps/insta',
        ];

        return [
            [$input, 20]
        ];
    }


    /**
     * @dataProvider provideIndex
     */
    public function testIndex($input, $count)
    {
        $this->truncateStorage($input['event']);
        
        $this->generate($input, time(), $count);

        $this->json('get', 'api/report/count', ['event' => 'audio.start'])
            ->seeJson([
                'total' => $count,
            ]);
    }

    /**
     * Validation error
     */
    public function testIndexValidationError()
    {
        $this->get('api/report/histogram')
            ->seeJsonStructure([
                'Error'
            ]);
    }


}