<?php

use Illuminate\Http\Request;
use Foundation\Form\FoundationFiveFormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\View\FileViewFinder;

class FormBuilderTest extends PHPUnit_Framework_TestCase {

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $this->urlGenerator = new UrlGenerator(new RouteCollection, Request::create('/foo', 'GET'));
        $this->viewFactory = new ViewFactory(
            new EngineResolver,
            new FileViewFinder($this->getMock('Illuminate\Filesystem\Filesystem'), []), $this->getMock('Illuminate\Events\Dispatcher')
        );
        $this->htmlBuilder  = new HtmlBuilder($this->urlGenerator, $this->viewFactory);
        $this->formBuilder  = new FoundationFiveFormBuilder($this->htmlBuilder, $this->urlGenerator, $this->viewFactory, 'abc',
            new ViewErrorBag);
        $this->attributes   = ['id' => 'test-input'];
    }

    public function testWrappedText()
    {
        $emptyInput          = $this->formBuilder->wrappedText('test', 'Test:');
        $filledInput         = $this->formBuilder->wrappedText('test', 'Test:', 'Testing');
        $inputWithAttributes = $this->formBuilder->wrappedText('test', 'Test:', 'Testing', $this->attributes);

        $this->assertEquals('<label>Test:<input name="test" type="text"></label>', $emptyInput);
        $this->assertEquals('<label>Test:<input name="test" type="text" value="Testing"></label>', $filledInput);
        $this->assertEquals(
            '<label>Test:<input id="test-input" name="test" type="text" value="Testing"></label>',
            $inputWithAttributes
        );
    }

    public function testWrappedTextarea()
    {
        $emptyInput          = $this->formBuilder->wrappedTextarea('test', 'Test:');
        $filledInput         = $this->formBuilder->wrappedTextarea('test', 'Test:', 'Testing');
        $inputWithAttributes = $this->formBuilder->wrappedTextarea('test', 'Test:', 'Testing', $this->attributes);

        $this->assertEquals('<label>Test:<textarea name="test" cols="50" rows="10"></textarea></label>', $emptyInput);
        $this->assertEquals(
            '<label>Test:<textarea name="test" cols="50" rows="10">Testing</textarea></label>',
            $filledInput
        );

        $this->assertEquals(
            '<label>Test:<textarea id="test-input" name="test" cols="50" rows="10">Testing</textarea></label>',
            $inputWithAttributes
        );
    }

    public function testWrappedPassword()
    {
        $emptyInput          = $this->formBuilder->wrappedPassword('test', 'Test:');
        $filledInput         = $this->formBuilder->wrappedPassword('test', 'Test:');
        $inputWithAttributes = $this->formBuilder->wrappedPassword('test', 'Test:', $this->attributes);


        $this->assertEquals(
            '<label>Test:<input name="test" type="password" value=""></label>',
            $emptyInput
        );

        $this->assertEquals(
            '<label>Test:<input name="test" type="password" value=""></label>',
            $filledInput
        );

        $this->assertEquals(
            '<label>Test:<input id="test-input" name="test" type="password" value=""></label>',
            $inputWithAttributes
        );

    }

    public function testWrappedSelect()
    {
        $emptyInput          = $this->formBuilder->wrappedSelect('test', 'Test:', range(1, 3));
        $filledInput         = $this->formBuilder->wrappedSelect('test', 'Test:', range(1, 3), 2);
        $inputWithAttributes = $this->formBuilder->wrappedSelect('test', 'Test:', range(1, 3), 2, $this->attributes);

        $this->assertEquals(
            '<label>Test:<select name="test"><option value="0">1</option><option value="1">2</option><option value="2">3</option></select></label>',
            $emptyInput
            );

        $this->assertEquals(
            '<label>Test:<select name="test"><option value="0">1</option><option value="1">2</option><option value="2" selected="selected">3</option></select></label>',
            $filledInput
        );

        $this->assertEquals(
            '<label>Test:<select id="test-input" name="test"><option value="0">1</option><option value="1">2</option><option value="2" selected="selected">3</option></select></label>',
            $inputWithAttributes
        );
    }

    public function testWrappedRadio()
    {
        $emptyInput          = $this->formBuilder->wrappedRadio('test', 'Test:', '1');
        $filledInput         = $this->formBuilder->wrappedRadio('test', 'Test:', '1', true);
        $inputWithAttributes = $this->formBuilder->wrappedRadio('test', 'Test:', '1', true, $this->attributes);

        $this->assertEquals(
            '<label>Test:<input name="test" type="radio" value="1"></label>',
            $emptyInput
        );

        $this->assertEquals(
            '<label>Test:<input checked="checked" name="test" type="radio" value="1"></label>',
            $filledInput
        );

        $this->assertEquals(
            '<label>Test:<input id="test-input" checked="checked" name="test" type="radio" value="1"></label>',
            $inputWithAttributes
        );
    }

    public function testWrappedCheckbox()
    {
        $emptyInput          = $this->formBuilder->wrappedCheckbox('test', 'Test:', '1');
        $filledInput         = $this->formBuilder->wrappedCheckbox('test', 'Test:', '1', true);
        $inputWithAttributes = $this->formBuilder->wrappedCheckbox('test', 'Test:', '1', true, $this->attributes);

        $this->assertEquals(
            '<label>Test:<input name="test" type="checkbox" value="1"></label>',
            $emptyInput
        );

        $this->assertEquals(
            '<label>Test:<input checked="checked" name="test" type="checkbox" value="1"></label>',
            $filledInput
        );

        $this->assertEquals(
            '<label>Test:<input id="test-input" checked="checked" name="test" type="checkbox" value="1"></label>',
            $inputWithAttributes
        );
    }

    public function testWrappedFile()
    {
        $emptyInput = $this->formBuilder->wrappedFile('test', 'Test:');

        $this->assertEquals('<label>Test:<input name="test" type="file"></label>', $emptyInput);
    }

    public function testErrorDisplay()
    {
        $viewErrorBag = new ViewErrorBag;
        $viewErrorBag->put('default', new MessageBag(['test' => ['Generic error message']]));

        $formBuilder = new FoundationFiveFormBuilder($this->htmlBuilder, $this->urlGenerator, $this->viewFactory, 'abc', $viewErrorBag);
        $input       = $formBuilder->wrappedText('test', 'Test:');

        $this->assertEquals('<label class="error">Test:<input class="error error" name="test" type="text"></label><small class="error">Generic error message</small>', $input);
    }

    public function testWrappedInput()
    {
        $emptyInput          = $this->formBuilder->wrappedInput('range', 'test', 'Test:');
        $filledInput         = $this->formBuilder->wrappedInput('range', 'test', 'Test:', 'Testing');
        $inputWithAttributes = $this->formBuilder->wrappedInput('range', 'test', 'Test:', 'Testing', $this->attributes);

        $this->assertEquals('<label>Test:<input name="test" type="range"></label>', $emptyInput);
        $this->assertEquals('<label>Test:<input name="test" type="range" value="Testing"></label>', $filledInput);
        $this->assertEquals(
            '<label>Test:<input id="test-input" name="test" type="range" value="Testing"></label>',
            $inputWithAttributes
        );
    }
}
