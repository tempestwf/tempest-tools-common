<?php

namespace TempestTools\Common\Contracts;

interface Annotated
{


    public function getAnnotations(): array;

    public function setAnnotations(array $annotations);

    public function annotationsToString(): string;
}