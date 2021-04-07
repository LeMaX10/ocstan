<?php

declare(strict_types=1);

namespace LeMaX10\OcStan\Methods;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use NunoMaduro\Larastan\Reflection\EloquentBuilderMethodReflection;
use NunoMaduro\Larastan\Methods\BuilderHelper as BuilderHelperBase;
use October\Rain\Database\Builder;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionVariantWithPhpDocs;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MissingMethodFromReflectionException;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Reflection\Php\DummyParameter;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\ShouldNotHappenException;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\Generic\TemplateTypeHelper;
use PHPStan\Type\Generic\TemplateTypeMap;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\VerbosityLevel;
use PHPStan\Type\VoidType;

/**
 * Class BuilderHelper
 * @package LeMaX10\OcStan\Methods
 */
class BuilderHelper extends BuilderHelperBase
{
    /** @var ReflectionProvider */
    private $reflectionProvider;

    /** @var bool */
    private $checkProperties;

    /** @var array */
    private $mapBuilders = [
        EloquentBuilder::class,
        Builder::class
    ];

    /**
     * @inheritDoc
     */
    public function determineBuilderType(string $modelClassName): string
    {
        $method = $this->reflectionProvider->getClass($modelClassName)->getNativeMethod('newEloquentBuilder');

        $returnType = ParametersAcceptorSelector::selectSingle($method->getVariants())->getReturnType();

        foreach ($this->mapBuilders as $builderClassName) {
            if (in_array($builderClassName, $returnType->getReferencedClasses(), true)) {
                return $builderClassName;
            }
        }

        if ($returnType instanceof ObjectType) {
            return $returnType->getClassName();
        }

        return $returnType->describe(VerbosityLevel::value());
    }
}
