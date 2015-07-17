<?php

class FullNameTest extends TestCase {

    /**
     * @param array $nameParts
     * @param string $expectedResult
     *
     * @dataProvider providerTestDeveloperFullName
     */
	public function testDeveloperFullName(array $nameParts, $expectedResult)
	{
		$developer = new App\Models\Developer;
        $developer->firstName = $nameParts['firstName'];
        $developer->middleName = $nameParts['middleName'];
        $developer->lastName = $nameParts['lastName'];

        $result = $developer->getFullNameAttribute();

		$this->assertEquals($expectedResult, $result);
	}

    public function providerTestDeveloperFullName()
    {
        return [
            [
                ['firstName' => 'Karin', 'middleName' => 'van den', 'lastName' => 'Berg'],
                'Karin van den Berg'
            ],
            [
                ['firstName' => 'Jakub', 'middleName' => '', 'lastName' => 'Gadkowski'],
                'Jakub Gadkowski'
            ],
        ];
    }



}
